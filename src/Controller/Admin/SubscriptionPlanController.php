<?php

namespace Controller\Admin;

use Form\SubscriptionPlanType;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Model\Pagination;
use Model\SubscriptionPlan;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("admin/subscription/plan")
 */
class SubscriptionPlanController extends AbstractController
{
    /**
     * @Route("/", name="subscription_plan_index", methods={"GET"})
     */
    public function index(): Response
    {
        $subscriptionPlans = $this->getDoctrine()
            ->getRepository(SubscriptionPlan::class)
            ->findAll();

        return $this->render('admin/subscription/plan/index.html.twig', [
            'subscription_plans' => $subscriptionPlans,
        ]);
    }

    /**
     * @Route("/new", name="subscription_plan_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $subscriptionPlan = new SubscriptionPlan();
        $form = $this->createForm(SubscriptionPlanType::class, $subscriptionPlan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subscriptionPlan);
            $entityManager->flush();

            return $this->redirectToRoute('subscription_plan_index');
        }

        return $this->render('admin/subscription/plan/new.html.twig', [
            'subscription_plan' => $subscriptionPlan,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subscription_plan_show", methods={"GET"})
     */
    public function show(SubscriptionPlan $subscriptionPlan): Response
    {
        return $this->render('admin/subscription/plan/show.html.twig', [
            'subscription_plan' => $subscriptionPlan,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="subscription_plan_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SubscriptionPlan $subscriptionPlan): Response
    {
        $form = $this->createForm(SubscriptionPlanType::class, $subscriptionPlan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subscription_plan_index');
        }

        return $this->render('admin/subscription/plan/edit.html.twig', [
            'subscription_plan' => $subscriptionPlan,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subscription_plan_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SubscriptionPlan $subscriptionPlan): Response
    {
        if ($this->isCsrfTokenValid('delete' . $subscriptionPlan->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($subscriptionPlan);
            $entityManager->flush();
        }

        return $this->redirectToRoute('subscription_plan_index');
    }


    public function index2(int $page = 1)
    {
        $itemsPerPage = 10;
        $offset = ($page - 1) * $itemsPerPage;

        $qb = $this->getDoctrine()
            ->getManager()
            ->getRepository(SubscriptionPlan::class)
            ->createQueryBuilder('s')
            ->setFirstResult($offset)
            ->setMaxResults($itemsPerPage);

        $plans = new Paginator($qb->getQuery());
        $pagination = new Pagination($page, \count($plans), $itemsPerPage);

        return $this->render(
            'admin/subscription/plan.list.html.twig',
            [
                'plans' => $plans,
                'pagination' => $pagination,
            ]
        );
    }


    public function delete2($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(SubscriptionPlan::class);
        $newsletterSubscription = $repository->find($id);

        if ($newsletterSubscription instanceof SubscriptionPlan) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($newsletterSubscription);
            $em->flush();
        }

        return $this->redirectToRoute('admin_subscription_plan_list');
    }
}
