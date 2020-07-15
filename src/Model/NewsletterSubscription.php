<?php
namespace Model;

use Symfony\Component\Validator\Constraints as Assert;
use Model\Traits\TimestampableTrait;

class NewsletterSubscription
{
    use TimestampableTrait;

    private ?int $id;
    private ?string $name;
    private bool $enabled;

    public function __construct(string $email = '', string $name = '')
    {
        $this->email = $email;
        $this->name = $name;
        $this->enabled = true;
    }

    /**
     * @Assert\Email(
     *     message = "The email is not valid.",
     * )
     */
    private string $email;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return NewsletterSubscription
     */
    public function setId(?int $id): NewsletterSubscription
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return NewsletterSubscription
     */
    public function setName(?string $name): NewsletterSubscription
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     * @return NewsletterSubscription
     */
    public function setEnabled(bool $enabled): NewsletterSubscription
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return NewsletterSubscription
     */
    public function setEmail(string $email): NewsletterSubscription
    {
        $this->email = $email;
        return $this;
    }

    public function getToken(): string
    {
        return base64_decode(md5(urlencode($this->email)));
    }

}