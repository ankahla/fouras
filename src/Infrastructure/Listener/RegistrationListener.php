<?php

namespace Infrastructure\Listener;

use Model\Couple;
use Model\Vendor;
use Services\GravatarService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Services\NewsletterManager;
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
    private $newsletterManager;

    public function __construct(EntityManagerInterface $em, GravatarService $gravatarService, NewsletterManager $newsletterManager)
    {
        $this->gravatarService = $gravatarService;
        $this->em = $em;
        $this->newsletterManager = $newsletterManager;
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

        $this->newsletterManager->subscribe($user->getEmail());

        $profile->setUser($user);
        $this->em->persist($profile);
        $this->em->persist($user);
        $this->em->flush();
    }
}
