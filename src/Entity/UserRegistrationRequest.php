<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRegistrationRequestRepository")
 * @ORM\Table(name="user_registration_request")
 */
class UserRegistrationRequest
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="registrationRequest")
     */
    private User $user;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private string $csrfProtectionToken;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTime $expiresAt;

    public function __construct()
    {
        $this->csrfProtectionToken = bin2hex(random_bytes(32));

        // expires withing one minute
        $expiresAt = new \DateTime("now");
        $expiresAt->add(new \DateInterval('PT1M'));
        $this->expiresAt = $expiresAt;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getCsrfProtectionToken(): string
    {
        return $this->csrfProtectionToken;
    }

    /**
     * @return \DateTime
     */
    public function getExpiresAt(): \DateTime
    {
        return $this->expiresAt;
    }
}
