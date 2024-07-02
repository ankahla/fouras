<?php

namespace Infrastructure\Controller\Admin;

use Doctrine\ORM\Tools\Pagination\Paginator;
use Model\NewsletterSubscription;
use Model\Pagination;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewsletterSubscribtionController extends AbstractController
{
    #[Route(path: '/admin/newsletter-subscribtion/{page}', name: 'admin_newsletter_subscribtion_list', requirements: ['page' => '\d+'])]
    public function index(int $page = 1)
    {
        $itemsPerPage = 10;
        $offset = ($page - 1) * $itemsPerPage;

        $qb = $this->getDoctrine()
            ->getManager()
            ->getRepository(NewsletterSubscription::class)
            ->createQueryBuilder('n')
            ->setFirstResult($offset)
            ->setMaxResults($itemsPerPage)
            ->orderBy('n.createdAt', 'DESC');

        $newsletterSubscriptions = new Paginator($qb->getQuery());
        $pagination = new Pagination($page, \count($newsletterSubscriptions), $itemsPerPage);

        return $this->render(
            'admin/newsletter/list.html.twig',
            [
                'newsletterSubscribtion' => $newsletterSubscriptions,
                'pagination' => $pagination,
            ]
        );
    }

    /**
     * Switch activation from enabled to disabled or from disabled to enabled
     */
    #[Route(path: '/admin/newsletter-subscribtion/{id}/switch-activation', name: 'admin_newsletter_subscribtion_switch_activation')]
    public function switchActivation($id)
    {
        $em = $this->getDoctrine()->getManager();
        /* @var NewsletterSubscription $newsletterSubscription */
        $newsletterSubscription = $em->getRepository(NewsletterSubscription::class)->find($id);

        if ($newsletterSubscription instanceof NewsletterSubscription) {
            $newsletterSubscription->setEnabled(!$newsletterSubscription->isEnabled());
            $em->persist($newsletterSubscription);
            $em->flush();
        }

        return $this->redirectToRoute('admin_newsletter_subscribtion_list');
    }

    #[Route(path: '/admin/newsletter-subscribtion/{id}/delete', name: 'admin_newsletter_subscribtion_delete')]
    public function delete($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(NewsletterSubscription::class);
        $newsletterSubscription = $repository->find($id);

        if ($newsletterSubscription instanceof NewsletterSubscription) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($newsletterSubscription);
            $em->flush();
        }

        return $this->redirectToRoute('admin_newsletter_subscribtion_list');
    }
}
