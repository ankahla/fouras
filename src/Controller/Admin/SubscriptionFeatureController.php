<?php

namespace Controller\Admin;

use Model\SubscriptionFeature;
use Form\SubscriptionFeatureType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/subscription/feature")
 */
class SubscriptionFeatureController extends AbstractController
{
    /**
     * @Route("/", name="subscription_feature_index", methods={"GET"})
     */
    public function index(): Response
    {
        $subscriptionFeatures = $this->getDoctrine()
            ->getRepository(SubscriptionFeature::class)
            ->findAll();

        return $this->render('admin/subscription/feature/index.html.twig', [
            'subscription_features' => $subscriptionFeatures,
        ]);
    }

    /**
     * @Route("/new", name="subscription_feature_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $subscriptionFeature = new SubscriptionFeature();
        $form = $this->createForm(SubscriptionFeatureType::class, $subscriptionFeature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subscriptionFeature);
            $entityManager->flush();

            return $this->redirectToRoute('subscription_feature_index');
        }

        return $this->render('admin/subscription/feature/new.html.twig', [
            'subscription_feature' => $subscriptionFeature,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subscription_feature_show", methods={"GET"})
     */
    public function show(SubscriptionFeature $subscriptionFeature): Response
    {
        return $this->render('admin/subscription/feature/show.html.twig', [
            'subscription_feature' => $subscriptionFeature,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="subscription_feature_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SubscriptionFeature $subscriptionFeature): Response
    {
        $form = $this->createForm(SubscriptionFeatureType::class, $subscriptionFeature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subscription_feature_index');
        }

        return $this->render('admin/subscription/feature/edit.html.twig', [
            'subscription_feature' => $subscriptionFeature,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subscription_feature_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SubscriptionFeature $subscriptionFeature): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subscriptionFeature->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($subscriptionFeature);
            $entityManager->flush();
        }

        return $this->redirectToRoute('subscription_feature_index');
    }
}
