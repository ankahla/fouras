<?php
namespace Infrastructure\Event;

use Model\Subscription;
use Symfony\Contracts\EventDispatcher\Event;

class SubscriptionValidationEvent extends Event
{
    /** @var Subscription */
    private $subscription;

    public function __construct(Subscription $subscriptionRequest)
    {
        $this->subscription = $subscriptionRequest;
    }

    public function getSubscription(): Subscription
    {
        return $this->subscription;
    }
}
