<?php


namespace Services;


use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Persistence\ObjectManager;
use Model\NewsletterSubscription;
use Model\User;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class NewsletterManager
{
    private const SESSION_KEY = 'newsletterSubscription';

    private ObjectManager $em;
    private SessionInterface $session;
    private TokenStorageInterface $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage, Registry $registry, SessionInterface $session)
    {
        $this->em = $registry->getManager();
        $this->session = $session;
        $this->tokenStorage = $tokenStorage;
        $this->initSession();
    }

    public function subscribe(string $email, string $name = ''): NewsletterSubscription
    {
        $repository = $this->em->getRepository(NewsletterSubscription::class);
        $newsletterSubscribtion = $repository->findOneByEmail($email);

        if (!$newsletterSubscribtion instanceof NewsletterSubscription) {
            $newsletterSubscribtion = new NewsletterSubscription($email, $name);
        }

        $userRepository = $this->em->getRepository(User::class);
        /** @var User $subscribingUser */
        $subscribingUser = $userRepository->findOneByEmail($email);

        if ($subscribingUser instanceof User) {
            $newsletterSubscribtion->setName($subscribingUser->getFirstName() . ' ' . $subscribingUser->getLastName());
            $userParams = $subscribingUser->getUserParams();
            $userParams->setNewsletterSubscribed(true);
            $this->em->persist($userParams);
        }

        $newsletterSubscribtion->setEnabled(true);
        $this->em->persist($newsletterSubscribtion);
        $this->em->flush();

        $this->session->set(self::SESSION_KEY, $email);

        return $newsletterSubscribtion;
    }

    public function unsubscribe(string $email, ?string $token = null): bool
    {
        $subscribtion = $this->em
            ->getRepository(NewsletterSubscription::class)
            ->findOneByEmail($email);

        if (!$subscribtion instanceof NewsletterSubscription) {
            return false;
        }

        // if token provided check is correct for security reason
        if ($token && $subscribtion->getToken() !== $token) {
            return false;
        }

        $subscribtion->setEnabled(false);

        /** @var User $subscribingUser */
        $subscribingUser = $this->em->getRepository(User::class)->findOneByEmail($email);

        if ($subscribingUser instanceof User) {
            $userParams = $subscribingUser->getUserParams();
            $userParams->setNewsletterSubscribed(false);
            $this->em->persist($userParams);
        }

        $this->em->persist($subscribtion);
        $this->em->flush();
        $this->session->set(self::SESSION_KEY, '');

        return true;
    }

    public function getSubscriptionFromSession(): ?NewsletterSubscription
    {
        $subscribedEmail = $this->session->get(self::SESSION_KEY);

        return empty($subscribedEmail) ? null : new NewsletterSubscription($subscribedEmail);
    }

    private function initSession(): void
    {
        $user = ($token = $this->tokenStorage->getToken()) ? $token->getUser() : null;

        if (is_null($this->session->get(self::SESSION_KEY))) {
            $subscribedEmail = '';

            if ($user instanceof User) {
                $subscription = $this->em
                    ->getRepository(NewsletterSubscription::class)
                    ->findOneBy(['email' => $user->getEmail(), 'enabled' => true]);

                if ($subscription instanceof NewsletterSubscription) {
                    $subscribedEmail = $subscription->getEmail();
                }
            }

            $this->session->set(self::SESSION_KEY, $subscribedEmail);
        }
    }
}
