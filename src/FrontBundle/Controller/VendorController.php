<?php

namespace FrontBundle\Controller;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Tools\Pagination\Paginator;
use AppBundle\Entity\Service;
use AppBundle\Entity\City;
use AppBundle\Entity\Couple;
use AppBundle\Entity\VendorService;
use AppBundle\Entity\Enquiry;
use AppBundle\Form\VendorServiceFilterType;
use AppBundle\Form\EnquiryType;

class VendorController extends AbstractController
{
    /**
     * @Route("/prestataires", name="vendors")
     */
    public function indexAction()
    {
        $services = $this->getDoctrine()->getRepository(Service::class)->findAll();

        return $this->render('FrontBundle::Vendor/categories.html.twig', ['services' => $services]);
    }

    /**
     * @Route("/prestataire/{id}/profile", name="vendor_profile")
     */
    public function profileAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $vendorService = $em->getRepository(VendorService::class)->findOneById($id);
        $user = $this->getUser();

        if (!$vendorService) {
            return $this->createNotFoundException('Service not found');           
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
        
        $request = $this->get('request_stack');
        
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

                $enquirySent = true;
            } else {
                // @todo
                //dump($form->getErrors());
            }
        }

        return $this->render('FrontBundle::Vendor/profile.html.twig',
            [
                'vendorService' => $vendorService,
                'enquirySent' => $enquirySent,
                'enquiryForm' => $enquiryForm ? $enquiryForm->createView() : null,
            ]
        );
    }

    /**
     * @Route("/prestataire/recherche/{serviceId}", name="vendor_search")
     */
    public function searchAction(Request $request, EntityManagerInterface $em, $serviceId = null)
    {
        $vendorServiceFilter = new VendorService();

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

        return $this->render('FrontBundle::Vendor/search.html.twig', [
                'vendorServices' => $vendorServices,
                'searchForm' => $searchForm->createView(),
            ]
        );
    }

    /**
     * @Route("/vendor_dashboard", name="vendor_dashboard")
     */
    public function dashboardAction()
    {
        return $this->render('FrontBundle::Vendor/Dashboard/dashboard.html.twig');
    }

    /**
     * @Route("/vendor_edit_profile", name="vendor_edit_profile")
     */
    public function editProfileAction()
    {
        return $this->render('FrontBundle::Vendor/Dashboard/profile.html.twig');
    }

    /**
     * @Route("/vendor_services", name="vendor_services")
     */
    public function ServicesAction()
    {
        return $this->render('FrontBundle::Vendor/Dashboard/services.html.twig');
    }

    /**
     * @Route("/vendor_add_service", name="vendor_add_service")
     */
    public function AddServiceAction()
    {
        return $this->render('FrontBundle::Vendor/Dashboard/serviceForm.html.twig');
    }
}
