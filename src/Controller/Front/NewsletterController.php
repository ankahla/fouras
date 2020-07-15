<?php


namespace Controller\Front;


use Form\NewsletterSubscriptionType;
use Model\NewsletterSubscription;
use Model\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class NewsletterController extends AbstractController
{
    /**
     * @Route("/subscribe-to-newsletter", name="newsletter_subscribtion")
     */
    public function index(Request $request, TranslatorInterface $translator)
    {
        $user = $this->getUser();
        $email = $user instanceof User ? $user->getEmail() : '';
        $em = $this->getDoctrine()->getManager();
        $newsletterScubscription = new NewsletterSubscription($email);
        $newsletterScubscriptionForm = $this->createForm(NewsletterSubscriptionType::class, $newsletterScubscription);

        if ($request->isMethod('POST')) {
            $newsletterScubscriptionForm->handleRequest($request);

            if ($newsletterScubscriptionForm->isSubmitted() && $newsletterScubscriptionForm->isValid()) {
                $repository = $em->getRepository(NewsletterSubscription::class);
                $existingSubscription = $repository->findOneByEmail($newsletterScubscription->getEmail());

                if ($existingSubscription instanceof NewsletterSubscription) {
                    $newsletterScubscription = $existingSubscription;
                }

                $userRepository = $em->getRepository(User::class);
                /** @var User $subscribingUser */
                $subscribingUser = $userRepository->findOneByEmail($newsletterScubscription->getEmail());

                if ($subscribingUser instanceof User) {
                    $newsletterScubscription->setName($subscribingUser->getFirstName() . ' ' . $subscribingUser->getLastName());
                    $userParams = $subscribingUser->getUserParams();
                    $userParams->setNewsletterSubscribed(true);
                    $em->persist($userParams);
                }


                $newsletterScubscription->setEnabled(true);
                $em->persist($newsletterScubscription);
                $em->flush();

                $request->getSession()->set('newsletterSubscription', true);
                $this->addFlash('info', $translator->trans('Thank you for subscribing to our newsletter'));
            }

            $referer = $request->headers->get('referer');

            return $this->redirect($referer);
        }

        return $this->render('front/pages/newsletter.subscribe.html.twig', [
            'subscriptionForm' => $newsletterScubscriptionForm->createView(),
            'alreadySubscribed' => $request->getSession()->get('newsletterSubscription'),
            'newsletterSubscribtion' => $newsletterScubscription
        ]);
    }

    /**
     * @Route("/unsubscribe-from-newsletter/{email}/{token}", name="newsletter_unsubscribtion")
     */
    public function unsubscribe(Request $request, $email, $token, TranslatorInterface $translator)
    {
        $email = urldecode($email);
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(NewsletterSubscription::class);
        $existingSubscription = $repository->findOneByEmail($email);

        if ($existingSubscription instanceof NewsletterSubscription && $existingSubscription->getToken() === $token) {
            $existingSubscription->setEnabled(false);

            $userRepository = $em->getRepository(User::class);
            /** @var User $subscribingUser */
            $subscribingUser = $userRepository->findOneByEmail($email);

            if ($subscribingUser instanceof User) {
                $userParams = $subscribingUser->getUserParams();
                $userParams->setNewsletterSubscribed(false);
                $em->persist($userParams);
            }

            $em->persist($existingSubscription);
            $em->flush();

            $request->getSession()->set('newsletterSubscription', false);
            $this->addFlash('info', $translator->trans('You are now unsubscribed from our newsletter'));
        }


        return $this->redirectToRoute('homepage');
    }
}