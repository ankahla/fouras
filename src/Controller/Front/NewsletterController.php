<?php


namespace Controller\Front;


use Form\NewsletterSubscriptionType;
use Model\NewsletterSubscription;
use Model\User;
use Services\NewsletterManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class NewsletterController extends AbstractController
{
    /**
     * @Route("/subscribe-to-newsletter", name="newsletter_subscribtion")
     */
    public function index(Request $request, NewsletterManager $newsletterManager, TranslatorInterface $translator)
    {
        $alreadySubscribed = false;
        $newsletterSubscribtion = $newsletterManager->getSubscriptionFromSession();

        if ($newsletterSubscribtion instanceof NewsletterSubscription) {
            $alreadySubscribed = true;
        } else {
            $user = $this->getUser();
            $email = $user instanceof User ? $user->getEmail() : '';
            $newsletterSubscribtion = new NewsletterSubscription($email);
        }

        $newsletterSubscribtionForm = $this->createForm(NewsletterSubscriptionType::class, $newsletterSubscribtion);

        if ($request->isMethod('POST')) {
            $newsletterSubscribtionForm->handleRequest($request);

            if ($newsletterSubscribtionForm->isSubmitted() && $newsletterSubscribtionForm->isValid()) {
                $newsletterManager->subscribe($newsletterSubscribtionForm->getData()->getEmail());
                $this->addFlash('info', $translator->trans('Thank you for subscribing to our newsletter'));
            }

            $referer = $request->headers->get('referer');

            return $this->redirect($referer);
        }

        return $this->render('front/pages/newsletter.subscribe.html.twig', [
            'subscriptionForm' => $newsletterSubscribtionForm->createView(),
            'alreadySubscribed' => $alreadySubscribed,
            'newsletterSubscribtion' => $newsletterSubscribtion
        ]);
    }

    /**
     * @Route("/unsubscribe-from-newsletter/{email}/{token}", name="newsletter_unsubscribtion")
     */
    public function unsubscribe($email, $token, NewsletterManager $newsletterManager, TranslatorInterface $translator)
    {
        $email = urldecode($email);

        if ($newsletterManager->unsubscribe($email, $token)) {
            $this->addFlash('info', $translator->trans('You are now unsubscribed from our newsletter'));
        }

        return $this->redirectToRoute('homepage');
    }
}