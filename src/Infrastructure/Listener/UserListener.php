<?php
namespace Infrastructure\Listener;

use Doctrine\Persistence\ManagerRegistry;
use Model\NewsletterSubscription;
use Model\Vendor;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Model\Couple;
use Model\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserListener
{
    private $tokenStorage;
    private $em;

    public function __construct(TokenStorageInterface $tokenStorage, ManagerRegistry $managerRegistry)
    {
        $this->tokenStorage = $tokenStorage;
        $this->em = $managerRegistry->getManager();
    }

    public function onKernelController(ControllerEvent $event)
    {
        $user = null;
        if (null !== $this->tokenStorage->getToken()) {
            $user = $this->tokenStorage->getToken()->getUser();
        }

        $address = '';
        $phone = '';

        if ($user instanceof User) {
            $session = $event->getRequest()->getSession();

            $profileName = '';

            if (is_null($session->get('newsletterSubscription'))) {
                $newsletterSubscription = $this->em
                    ->getRepository(NewsletterSubscription::class)
                    ->findOneBy(['email' => $user->getEmail(), 'enabled' => true]);

                $session->set('newsletterSubscription', ($newsletterSubscription instanceof NewsletterSubscription));
            }

            if (!$user->isVendor()) {
                /** @var Couple $couple **/
                $couple = $this->em->getRepository(Couple::class)->findOneByUser($user);

                if ($couple instanceof Couple) {
                    $wife = $couple->getWife();
                    $husband = $couple->getHusband();
                    $profileName = '';
                    if ($wife->getFirstName() && $husband->getFirstName()) {
                        $profileName = $wife->getFirstName() . ' & ' .$husband->getFirstName();
                    }
                    $address = $husband->getAddress() ? $husband->getAddress() : $wife->getAddress();
                    $phone = $husband->getPhone() ? $husband->getPhone() : $wife->getPhone();
                }
            } else {
                /** @var Vendor $vendor **/
                $vendor = $this->em->getRepository(Vendor::class)->findOneByUser($user);

                if ($vendor instanceof Vendor) {
                    $profileName = $vendor->getFirstName().' '.$vendor->getLastName();
                    $address = $vendor->getAddress();
                    $phone = $vendor->getPhone() ? $vendor->getPhone() : $vendor->getMobile();
                }
            }

            $session->set("profileName", $profileName);
            $session->set("phone", $phone);
            $session->set("address", $address);
        }
    }
}
