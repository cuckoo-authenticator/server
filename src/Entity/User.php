<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Ulid;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UlidGenerator::class)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private string $authenticationToken;

    /**
     * @ORM\Column(type="string", length=56, nullable=true)
     */
    private string $wrappedVaultKey;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isRegistered;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\UserRegistrationRequest", mappedBy="user")
     */
    private UserRegistrationRequest $registrationRequest;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Secret", mappedBy="user")
     */
    private Collection $secrets;

    public function __construct()
    {
        $this->isRegistered = false;
        $this->secrets = new ArrayCollection();
    }

    /**
     * @return Ulid
     */
    public function getId(): Ulid
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAuthenticationToken(): string
    {
        return $this->authenticationToken;
    }

    /**
     * @param string $authenticationToken
     */
    public function setAuthenticationToken(string $authenticationToken): void
    {
        $this->authenticationToken = $authenticationToken;
    }

    /**
     * @return string
     */
    public function getWrappedVaultKey(): string
    {
        return $this->wrappedVaultKey;
    }

    /**
     * @param string $wrappedVaultKey
     */
    public function setWrappedVaultKey(string $wrappedVaultKey): void
    {
        $this->wrappedVaultKey = $wrappedVaultKey;
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

    /**
     * The public representation of the user (e.g. a username, an email address, etc.)
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->id;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection | Secret[]
     */
    public function getSecrets(): Collection
    {
        return $this->secrets;
    }
}
