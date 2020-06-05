<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Entity;

use App\Repository\ClientUserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Entity Class ClientUser.
 *
 * @ORM\Entity(repositoryClass=ClientUserRepository::class)
 * @UniqueEntity(fields={"email"}, message="This ClientUser already exists", groups={"user"})
 */
class ClientUser
{
    /**
     * @var int
     *
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
     * @ORM\Column(type="string", length=50)
     *
     * @Assert\NotBlank(message="You must add a name", groups={"user"})
     * @Assert\Length(
     *     min=3,
     *     max=50,
     *     minMessage="The name should contain at least {{ limit }} characters",
     *     maxMessage="The name should not contain more than {{ limit }} characters",
     *     allowEmptyString=false,
     *     groups={"user"}
     * )
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=30, unique=true)
     *
     * @Assert\NotBlank(message="You must add a username", groups={"user"})
     * @Assert\Length(
     *     min=3,
     *     max=30,
     *     minMessage="The name should contain at least {{ limit }} characters",
     *     maxMessage="The name should not contain more than {{ limit }} characters",
     *     allowEmptyString=false,
     *     groups={"user"}
     * )
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, unique=true)
     *
     * @Assert\NotBlank(message="You must enter an email", groups={"user"})
     * @Assert\Email(
     *     message="The Email '{{ value }}' is not a valid email",
     *     groups={"user"}
     * )
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
