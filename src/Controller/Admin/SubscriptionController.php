<?php

namespace Controller\Admin;

use Doctrine\ORM\Tools\Pagination\Paginator;
use Model\Pagination;
use Model\Subscription;
use Form\SubscriptionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/subscription")
 */
class SubscriptionController extends AbstractController
{
    /**
     * @Route("/list/{page}", name="subscription_index", methods={"GET"}, requirements={"page":"\d+"})
     */
    public function index(int $page = 1): Response
    {
        $itemsPerPage = 10;
        $offset = ($page - 1) * $itemsPerPage;

        $qb = $this->getDoctrine()
            ->getManager()
            ->getRepository(Subscription::class)
            ->createQueryBuilder('s')
            ->setFirstResult($offset)
            ->setMaxResults($itemsPerPage);

        $subscriptions = new Paginator($qb->getQuery());
        $pagination = new Pagination($page, \count($subscriptions), $itemsPerPage);

        return $this->render(
            'admin/subscription/subscription/index.html.twig',
            [
                'subscriptions' => $subscriptions,
                'pagination' => $pagination,
            ]
        );
    }

    /**
     * @Route("/new", name="subscription_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $subscription = new Subscription();
        $form = $this->createForm(SubscriptionType::class, $subscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subscription);
            $entityManager->flush();

            return $this->redirectToRoute('subscription_index');
        }

        return $this->render('admin/subscription/subscription/new.html.twig', [
            'subscription' => $subscription,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subscription_show", requirements={"id":"\d+"}, methods={"GET"})
     */
    public function show(Subscription $subscription): Response
    {
        return $this->render('admin/subscription/subscription/show.html.twig', [
            'subscription' => $subscription,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="subscription_edit", methods={"GET","POST"}, requirements={"id":"\d+"})
     */
    public function edit(Request $request, Subscription $subscription): Response
    {
        $form = $this->createForm(SubscriptionType::class, $subscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subscription_index');
        }

        return $this->render('admin/subscription/subscription/edit.html.twig', [
            'subscription' => $subscription,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subscription_delete", methods={"DELETE"}, requirements={"id":"\d+"})
     */
    public function delete(Request $request, Subscription $subscription): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subscription->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($subscription);
            $entityManager->flush();
        }

        return $this->redirectToRoute('subscription_index');
    }
}
