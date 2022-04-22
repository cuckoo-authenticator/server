<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UlidGenerator::class)
     */
    private $id;

    /**
     * @ORM\Column(type="binary", length=32, nullable=true)
     */
    private $authenticationToken;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isRegistered;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\UserRegistrationRequest", mappedBy="user")
     */
    private UserRegistrationRequest $registrationRequest;

    public function __construct()
    {
        $this->isRegistered = false;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAuthenticationToken(): mixed
    {
        return $this->authenticationToken;
    }

    /**
     * @param mixed $authenticationToken
     */
    public function setAuthenticationToken(mixed $authenticationToken): void
    {
        $this->authenticationToken = $authenticationToken;
    }

    /**
     * @return bool
     */
    public function getIsRegistered(): bool
    {
        return $this->isRegistered;
    }

    /**
     * @param bool $isRegistered
     */
    public function setIsRegistered(bool $isRegistered): void
    {
        $this->isRegistered = $isRegistered;
    }

    /**
     * @return UserRegistrationRequest
     */
    public function getRegistrationRequest(): UserRegistrationRequest
    {
        return $this->registrationRequest;
    }

    /**
     * @param UserRegistrationRequest $registrationRequest
     */
    public function setRegistrationRequest(UserRegistrationRequest $registrationRequest): void
    {
        $this->registrationRequest = $registrationRequest;
    }
}
