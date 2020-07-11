<?php
namespace Infrastructure\Event;

use Model\Enquiry;
use Symfony\Contracts\EventDispatcher\Event;

class EnquiryEvent extends Event
{
    /** @var Enquiry */
    private $enquiry;

    public function __construct(Enquiry $enquiry)
    {
        $this->enquiry = $enquiry;
    }

    public function getEnquiry(): Enquiry
    {
        return $this->enquiry;
    }
}
