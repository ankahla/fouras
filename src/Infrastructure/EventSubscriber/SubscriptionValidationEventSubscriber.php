<?php
namespace Infrastructure\EventSubscriber;

use Infrastructure\Event\SubscriptionValidationEvent;
use Model\Subscription;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Psr\Log\NullLogger;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Environment;

class SubscriptionValidationEventSubscriber implements EventSubscriberInterface, LoggerAwareInterface
{
    use LoggerAwareTrait;

    private $mailer;
    private $twig;
    private $translator;
    private $defaultMailerSender;

    public function __construct(\Swift_Mailer $mailer, Environment $twig, TranslatorInterface $translator, string $defaultMailerSender)
    {
        $this->logger = new NullLogger();
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->translator = $translator;
        $this->defaultMailerSender = $defaultMailerSender;
    }

    public static function getSubscribedEvents(): array
    {
        return [SubscriptionValidationEvent::class => 'onValidation'];
    }

    public function onValidation(SubscriptionValidationEvent $event): void
    {
        /** @var Subscription $subscription */
        $subscription = $event->getSubscription();
        $userParams = $subscription->getUser()->getUserParams();

        if ($userParams->isEmailNotificationsEnabled()) {
            $this->logger->debug('Sending subscription validation email to vendor');

            $from = $this->defaultMailerSender;
            $userEmail = $subscription->getUser()->getEmail();
            $to = [$userEmail => (string) $subscription->getUser()];
            $locale = $userParams->getEmailLanguage();

            $message = (new \Swift_Message($this->translator->trans('Subscription to the plan validated', [], 'email', $locale)))
                ->setFrom($from)
                ->setTo($to)
                ->setBody(
                    $this->twig->render(
                        'front/mail/subscription.validated.html.twig',
                        ['subscription' => $subscription, 'locale' => $locale]
                    ),
                    'text/html'
                );

            $this->mailer->send($message);
        } else {
            $this->logger->debug('Sending enquiry cancelled due to user preferences');
        }
    }
}
