<?php

namespace Controller\Admin;

use Infrastructure\Event\SubscriptionValidationEvent;
use Model\Subscription;
use Model\SubscriptionArchived;
use Model\SubscriptionRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/subscription/request")
 */
class SubscriptionRequestController extends AbstractController
{
    /**
     * @Route("/", name="subscription_request_index", methods={"GET"})
     */
    public function index(): Response
    {
        $subscriptionRequestRepository = $this->getDoctrine()->getRepository(SubscriptionRequest::class);

        return $this->render('admin/subscription/request/index.html.twig', [
            'subscription_requests' => $subscriptionRequestRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="subscription_request_show", methods={"GET"})
     */
    public function show(SubscriptionRequest $subscriptionRequest): Response
    {
        return $this->render('admin/subscription/request/show.html.twig', [
            'subscription_request' => $subscriptionRequest,
        ]);
    }

    /**
     * @Route("/{id}/validate", name="subscription_request_validate", methods={"GET"})
     */
    public function validate(SubscriptionRequest $subscriptionRequest, EventDispatcherInterface $eventDispatcher): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        if ($subscription = $subscriptionRequest->getUser()->getSubscription()) {
            $archivedSubscription = (new SubscriptionArchived())
                ->setPlan($subscription->getPlan())
                ->setUser($subscription->getUser())
                ->setStartAt($subscription->getStartAt())
                ->setEndAt($subscription->getEndAt());

            $entityManager->persist($archivedSubscription);
        } else {
            $subscription = new Subscription();
        }

        $subscription
            ->setPlan($subscriptionRequest->getPlan())
            ->setUser($subscriptionRequest->getUser())
            ->setActive(true)
            ->setStartAt(new \DateTime())
            ->setEndAt(new \DateTime('+ 1 month'));

        $entityManager->persist($subscription);
        $entityManager->remove($subscriptionRequest);

        $entityManager->flush();

        $eventDispatcher->dispatch(new SubscriptionValidationEvent($subscription));

        return $this->redirectToRoute('subscription_request_index');
    }

    /**
     * @Route("/{id}", name="subscription_request_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SubscriptionRequest $subscriptionRequest): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subscriptionRequest->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($subscriptionRequest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('subscription_request_index');
    }
}
