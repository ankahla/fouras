<?php
namespace AppBundle\Listener;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use AppBundle\Entity\Couple;
use AppBundle\Entity\User;
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

        $profileName = 'TODO Vendor';
        $address = '';
        $phone = '';

        if (is_object($user) && $user instanceof User) {
            $session = $event->getRequest()->getSession();

            if(!$session) return;

            $profileName = '';
            if ($user->isVendor()) {
                // @TODO
            } else {
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
            }

            $session->set("profileName", $profileName);
            $session->set("phone", $phone);
            $session->set("address", $address);
        }

    }
}