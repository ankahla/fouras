<?php
namespace Infrastructure\Listener;

use Doctrine\Persistence\ManagerRegistry;
use Model\Vendor;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Model\Couple;
use Model\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserListener
{
    private $em;

    public function __construct(private readonly TokenStorageInterface $tokenStorage, ManagerRegistry $managerRegistry)
    {
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
                    $address = $husband->getAddress() ?: $wife->getAddress();
                    $phone = $husband->getPhone() ?: $wife->getPhone();
                }
            } else {
                /** @var Vendor $vendor **/
                $vendor = $this->em->getRepository(Vendor::class)->findOneByUser($user);

                if ($vendor instanceof Vendor) {
                    $profileName = $vendor->getFirstName().' '.$vendor->getLastName();
                    $address = $vendor->getAddress();
                    $phone = $vendor->getPhone() ?: $vendor->getMobile();
                }
            }

            $session->set("profileName", $profileName);
            $session->set("phone", $phone);
            $session->set("address", $address);
        }
    }
}
