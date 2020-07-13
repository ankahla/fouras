<?php
namespace Model;

class UserParams
{
    private $id;
    private bool $emailNotificationsEnabled = true;
    private bool $enquiryNotificationsEnabled = true;
    private bool $newsletterSubscribed = true;
    private bool $phoneNumberHidden = false;
    private string $emailLanguage = 'fr';

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return UserParams
     */
    public function setId(int $id): UserParams
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEmailNotificationsEnabled(): bool
    {
        return $this->emailNotificationsEnabled;
    }

    /**
     * @param bool $emailNotificationsEnabled
     * @return UserParams
     */
    public function setEmailNotificationsEnabled(bool $emailNotificationsEnabled): UserParams
    {
        $this->emailNotificationsEnabled = $emailNotificationsEnabled;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEnquiryNotificationsEnabled(): bool
    {
        return $this->enquiryNotificationsEnabled;
    }

    /**
     * @param bool $enquiryNotificationsEnabled
     * @return UserParams
     */
    public function setEnquiryNotificationsEnabled(bool $enquiryNotificationsEnabled): UserParams
    {
        $this->enquiryNotificationsEnabled = $enquiryNotificationsEnabled;
        return $this;
    }

    /**
     * @return bool
     */
    public function isNewsletterSubscribed(): bool
    {
        return $this->newsletterSubscribed;
    }

    /**
     * @param bool $newsletterSubscribed
     * @return UserParams
     */
    public function setNewsletterSubscribed(bool $newsletterSubscribed): UserParams
    {
        $this->newsletterSubscribed = $newsletterSubscribed;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPhoneNumberHidden(): bool
    {
        return $this->phoneNumberHidden;
    }

    /**
     * @param bool $phoneNumberHidden
     * @return UserParams
     */
    public function setPhoneNumberHidden(bool $phoneNumberHidden): UserParams
    {
        $this->phoneNumberHidden = $phoneNumberHidden;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmailLanguage(): string
    {
        return $this->emailLanguage;
    }

    /**
     * @param string $emailLanguage
     * @return UserParams
     */
    public function setEmailLanguage(string $emailLanguage): UserParams
    {
        $this->emailLanguage = $emailLanguage;
        return $this;
    }
}
