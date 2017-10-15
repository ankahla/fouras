<?php
namespace AppBundle\Listener;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\Bundle\DoctrineBundle\Registry;
use AppBundle\Entity\Couple;
use AppBundle\Entity\User;

class UserListener
{
    private $securityContext;
    private $managerRegistry;
    private $em;

    public function __construct(SecurityContext $securityContext, Registry $managerRegistry)
    {
        $this->securityContext = $securityContext;
        $this->managerRegistry = $managerRegistry;
        $this->em = $managerRegistry->getEntityManager();
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $user = null;
        if ($this->securityContext->getToken()) {
            $user = $this->securityContext->getToken()->getUser();
        }

        $profileName = 'TODO Vendor';
        $address = '';
        $phone = '';

        if (is_object($user) && $user instanceof User) {
            $session = $event->getRequest()->getSession();

            $profileName = '';
            if ($user->isVendor()) {
                // TODO
            } else {
                $couple = $this->em->getRepository(Couple::class)->findOneByUser($user);

                if ($couple) {
                    $wife = $couple->getWife();
                    $husband = $couple->getHusband();
                    $profileName = $wife->getFirstName() . ' & ' .$husband->getFirstName();
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