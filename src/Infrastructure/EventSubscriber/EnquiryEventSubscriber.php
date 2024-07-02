<?php
namespace Infrastructure\EventSubscriber;

use Infrastructure\Event\EnquiryEvent;
use Model\Enquiry;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Psr\Log\NullLogger;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Environment;

class EnquiryEventSubscriber implements EventSubscriberInterface, LoggerAwareInterface
{
    use LoggerAwareTrait;

    private $mailer = null;
    private $defaultMailerSender;

    //public function __construct(\Swift_Mailer $mailer, Environment $twig, TranslatorInterface $translator, string $defaultMailerSender)
    public function __construct(private Environment $twig, private TranslatorInterface $translator)
    {
        $this->logger = new NullLogger();
        //$this->defaultMailerSender = $defaultMailerSender;
    }

    public static function getSubscribedEvents(): array
    {
        return [EnquiryEvent::class => 'onSentEnquiry'];
    }

    public function onSentEnquiry(EnquiryEvent $event): void
    {
        /** @var Enquiry $enquiry */
        $enquiry = $event->getEnquiry();
        $userParams = $enquiry->getVendor()->getUser()->getUserParams();

        if ($userParams->isEmailNotificationsEnabled() && $userParams->isEnquiryNotificationsEnabled()) {
            $this->logger->debug('Sending enquiry email to vendor');

            $from = $enquiry->isEmailResponseBack() ? [$enquiry->getEmail() => (string) $enquiry->getCouple()] : $this->defaultMailerSender;
            $vendorEmail = $enquiry->getVendorService()->getEmail() ?: $enquiry->getVendor()->getEmail();
            $to = [$vendorEmail => (string) $enquiry->getVendor()];
            $locale = $userParams->getEmailLanguage();

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
        } else {
            $this->logger->debug('Sending enquiry cancelled due to user preferences');
        }
    }
}
