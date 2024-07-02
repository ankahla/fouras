<?php

namespace Infrastructure\Controller\Front;

use Infrastructure\Event\EnquiryEvent;
use Model\SearchVendorService;
use Model\User;
use Doctrine\ORM\EntityManagerInterface;
use OneCarrefour\Common\Domain\Manager\MediaManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Model\Service;
use Model\City;
use Model\Couple;
use Model\VendorService;
use Model\Enquiry;
use Infrastructure\Form\VendorServiceFilterType;
use Infrastructure\Form\EnquiryType;
use Symfony\Component\Routing\RouterInterface;

class VendorController extends AbstractController
{
    #[Route(path: '/prestataires', name: 'vendors')]
    public function indexAction(RouterInterface $router)
    {
        $services = $this->getDoctrine()->getRepository(Service::class)->findAll();

        return $this->render('front/vendor/categories.html.twig', ['services' => $services]);
    }

    #[Route(path: '/prestataire/{id}/profile', name: 'vendor_profile')]
    public function profileAction(Request $request, EventDispatcherInterface $dispatcher, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $vendorService = $em->getRepository(VendorService::class)->findOneById($id);
        $user = $this->getUser();

        if (!$vendorService) {
            throw $this->createNotFoundException('Service not found');
        }

        $enquirySent = false;
        $enquiryForm = null;
        $enquiry = new Enquiry();
        $enquiry
            ->setVendor($vendorService->getVendor())
            ->setVendorService($vendorService);

        if ($user instanceof User && $user->isCouple()) {
            $couple = $em->getRepository(Couple::class)->findOneByUser($user);

            $qb = $em->getRepository(Enquiry::class)->createQueryBuilder('enquiry')->setMaxResults(1);

            if ($couple) {
                $query = $qb
                    ->andWhere('enquiry.vendorService = :vendorServiceId')
                    ->andWhere('enquiry.couple = :coupleId')
                    ->setParameter('vendorServiceId', $vendorService->getId())
                    ->setParameter('coupleId', $couple->getId())
                    ->getQuery();

                $enquiries = $query->getResult();
                
                if (count($enquiries) == 0) {
                    $enquiry->setCouple($couple);
                    $enquiryForm = $this->createForm(EnquiryType::class, $enquiry);
                } else {
                    $enquirySent = true;
                }
            }
        }
        
        if ($request->isMethod('POST') && !$enquirySent) {
            $enquiryForm->handleRequest($request);

            if ($enquiryForm && $enquiryForm->isSubmitted() && $enquiryForm->isValid()) {
                $postedEnquiry = $enquiryForm->getData();
                $postedEnquiry
                    ->setVendor($enquiry->getVendor())
                    ->setCouple($enquiry->getCouple())
                    ->setVendorService($enquiry->getVendorService());

                $em->persist($postedEnquiry);
                $em->flush();

                $dispatcher->dispatch(new EnquiryEvent($enquiry));
                $enquirySent = true;
            } else {
                // @todo
                //$form->getErrors()
            }
        }

        return $this->render(
            'front/vendor/profile.html.twig',
            [
                'vendorService' => $vendorService,
                'enquirySent' => $enquirySent,
                'enquiryForm' => $enquiryForm ? $enquiryForm->createView() : null,
            ]
        );
    }

    #[Route(path: '/prestataire/recherche/{serviceId}', name: 'vendor_search')]
    public function searchAction(Request $request, EntityManagerInterface $em, $serviceId = null)
    {
        $vendorServiceFilter = new SearchVendorService();

        if ($serviceId) {
            $service = $em->getRepository(Service::class)->findOneById($serviceId);
            $vendorServiceFilter->setService($service);
        }

        $cityId = $request->query->get('cityId');

        if ($cityId) {
            $city = $em->getRepository(City::class)->findOneById($cityId);
            $vendorServiceFilter->setCity($city);
        }

        $searchForm = $this->createForm(VendorServiceFilterType::class, $vendorServiceFilter);
        
        if ($request->isMethod('POST')) {
            $searchForm->handleRequest($request);
        }

        $qb = $em->getRepository(VendorService::class)->createQueryBuilder('vs')
            ->setFirstResult(0)
            ->setMaxResults(100);


        if ($vendorServiceFilter->getService()) {
            $qb
                ->andWhere('vs.service = :serviceId')
                ->setParameter('serviceId', $vendorServiceFilter->getService()->getId());
        }

        if ($vendorServiceFilter->getCity()) {
            $qb
                ->andWhere('vs.city = :cityId')
                ->setParameter('cityId', $vendorServiceFilter->getCity()->getId());
        }

        $qb
            ->andWhere('vs.costMin >= :costMin')
            ->andWhere('vs.costMax <= :costMax')
            ->setParameter('costMin', $vendorServiceFilter->getcostMin())
            ->setParameter('costMax', $vendorServiceFilter->getcostMax())
        ;

        $vendorServices = new Paginator($qb->getQuery());

        return $this->render(
            'front/vendor/search.html.twig',
            [
                'vendorServices' => $vendorServices,
                'searchForm' => $searchForm,
            ]
        );
    }
}
