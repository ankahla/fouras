<?php
namespace Infrastructure\Event;

use Model\Enquiry;
use Symfony\Contracts\EventDispatcher\Event;

class EnquiryEvent extends Event
{
    public function __construct(private readonly Enquiry $enquiry)
    {
    }

    public function getEnquiry(): Enquiry
    {
        return $this->enquiry;
    }
}
