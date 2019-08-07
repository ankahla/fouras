<?php

namespace UserBundle\Listener;

use AppBundle\Entity\Couple;
use AppBundle\Entity\Vendor;
use AppBundle\Services\GravatarService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\File\File;

/**
 * RegistrationListener
 */
class RegistrationListener implements EventSubscriberInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    private $gravatarService;

    public function __construct(EntityManagerInterface $em, GravatarService $gravatarService)
    {
        $this->gravatarService = $gravatarService;
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess',
        ];
    }

    public function onRegistrationSuccess(FormEvent $event)
    {
        $user = $event->getForm()->getData();

        $src = $this->gravatarService->getSrcByEmail($user->getEmail());
        $user->setProfilePicture(new File($src, false));

        if ($user->isVendor()) {
            $user->addRole('ROLE_VENDOR');
            $profile = new Vendor();
        } else {
            $user->addRole('ROLE_COUPLE');
            $profile = new Couple();
        }

        $profile->setUser($user);
        $this->em->persist($profile);
        $this->em->persist($user);
        $this->em->flush();
    }
}