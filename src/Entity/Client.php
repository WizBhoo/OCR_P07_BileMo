<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Entity Class Client.
 *
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client implements UserInterface
{
    /**
     * @var int
     *
     * @Groups("client")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @Groups("client")
     * @ORM\Column(type="string", length=30, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @Groups("client")
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $email;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity=ClientUser::class, mappedBy="client", orphanRemoval=true)
     */
    private $clientUsers;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->clientUsers = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getClientUsers(): Collection
    {
        return $this->clientUsers;
    }

    /**
     * @param ClientUser $clientUser
     *
     * @return $this
     */
    public function addClientUser(ClientUser $clientUser): self
    {
        if (!$this->clientUsers->contains($clientUser)) {
            $this->clientUsers[] = $clientUser;
            $clientUser->setClient($this);
        }

        return $this;
    }

    /**
     * @param ClientUser $clientUser
     *
     * @return $this
     */
    public function removeClientUser(ClientUser $clientUser): self
    {
        if ($this->clientUsers->contains($clientUser)) {
            $this->clientUsers->removeElement($clientUser);
            if ($clientUser->getClient() === $this) {
                $clientUser->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return [];
    }

    /**
     * @see UserInterface
     */
    public function getPassword()
    {
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->email;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
    }
}
