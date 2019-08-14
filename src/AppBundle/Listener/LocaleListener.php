<?php
namespace AppBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class LocaleListener implements EventSubscriberInterface
{
    private $defaultLocale;

    public function __construct($defaultLocale = 'fr')
    {
        $this->defaultLocale = $defaultLocale;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        $session = null;

        if ($request->hasSession() && ($session = $request->getSession())) {
            $locale = $request->attributes->get('_locale') ?
                $request->attributes->get('_locale') :
                $request->get('_locale');
            // var_dump($locale);
            // try to see if the locale has been set as a _locale routing parameter
            if ($locale) {
                $session->set('_locale', $locale);
            } else {
                $locale = $session->get('_locale', $this->defaultLocale);
            }

            $request->setLocale($locale);
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            // must be registered after the default Locale listener
            KernelEvents::REQUEST => [['onKernelRequest', 15]],
        );
    }
}