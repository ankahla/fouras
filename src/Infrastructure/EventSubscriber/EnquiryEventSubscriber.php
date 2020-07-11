<?php
namespace Infrastructure\EventSubscriber;

use Infrastructure\Event\EnquiryEvent;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Psr\Log\NullLogger;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Environment;

class EnquiryEventSubscriber implements EventSubscriberInterface, LoggerAwareInterface
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
        return [EnquiryEvent::class => 'onSentEnquiry'];
    }

    public function onSentEnquiry(EnquiryEvent $event): void
    {
        $enquiry = $event->getEnquiry();
        $this->logger->debug('Sending enquiry email to vendor');
        $from = $enquiry->isEmailResponseBack() ? [$enquiry->getEmail() => (string) $enquiry->getCouple()] : $this->defaultMailerSender;
        $to = [$enquiry->getVendor()->getEmail() => (string) $enquiry->getVendor()];
        $locale = 'fr';

        $message = (new \Swift_Message($this->translator->trans('Enquiry received', [], 'email', $locale)))
            ->setFrom($from)
            ->setTo($to)
            ->setBody(
                $this->twig->render(
                    'front/mail/enquiry.received.html.twig',
                    ['enquiry' => $enquiry, 'locale' => $locale]
                ),
                'text/html'
            );

        $this->mailer->send($message);
    }
}