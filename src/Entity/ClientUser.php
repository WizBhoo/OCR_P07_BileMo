<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Entity;

use App\Repository\ClientUserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Entity Class ClientUser.
 *
 * @ORM\Entity(repositoryClass=ClientUserRepository::class)
 * @UniqueEntity(fields={"email"}, message="Choose another email")
 * @UniqueEntity(fields={"username"}, message="Choose another username")
 */
class ClientUser
{
    /**
     * @var int
     *
     * @Groups({"user_details", "user_list"})
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Client
     *
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="clientUsers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @var string
     *
     * @Groups({"user_details", "user_list"})
     * @ORM\Column(type="string", length=50)
     *
     * @Assert\NotBlank(message="You must add a name")
     * @Assert\Length(
     *     min=3,
     *     max=50,
     *     minMessage="The name should contain at least {{ limit }} characters",
     *     maxMessage="The name should not contain more than {{ limit }} characters",
     *     allowEmptyString=false
     * )
     */
    private $name;

    /**
     * @var string
     *
     * @Groups("user_details")
     * @ORM\Column(type="string", length=30, unique=true)
     *
     * @Assert\NotBlank(message="You must add a username")
     * @Assert\Length(
     *     min=3,
     *     max=30,
     *     minMessage="The name should contain at least {{ limit }} characters",
     *     maxMessage="The name should not contain more than {{ limit }} characters",
     *     allowEmptyString=false
     * )
     */
    private $username;

    /**
     * @var string
     *
     * @Groups("user_details")
     * @ORM\Column(type="string", length=100, unique=true)
     *
     * @Assert\NotBlank(message="You must enter an email")
     * @Assert\Email(message="The Email '{{ value }}' is not a valid email")
     */
    private $email;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Client|null
     */
    public function getClient(): ?Client
    {
        return $this->client;
    }

    /**
     * @param Client|null $client
     *
     * @return $this
     */
    public function setClient(?Client $client): self
    {
        $this->client = $client;

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
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $username
     *
     * @return $this
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

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
}
