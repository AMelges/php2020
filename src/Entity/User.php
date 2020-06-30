<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User.
 *
 * @ORM\Table(
 *     name="users",
 *     uniqueConstraints={
 *     @ORM\UniqueConstraint(name="ID_UNIQUE", columns={"ID"}),
 *     @ORM\UniqueConstraint(name="email_UNIQUE", columns={"email"})})
 *
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 *
 * @UniqueEntity(fields={"email"})
 */
class User implements UserInterface
{
    /**
     * Role admin.
     *
     * @var string
     */
    const ROLE_ADMIN = 'ROLE_ADMIN';

    /**
     * Role king.
     *
     * @var string
     */
    const ROLE_KING = 'ROLE_KING';

    /**
     * Role chieftain.
     *
     * @var string
     */
    const ROLE_CHIEFTAIN = 'ROLE_CHIEFTAIN';

    /**
     * Role inkeeper.
     *
     * @var string
     */
    const ROLE_INNKEEPER = 'ROLE_INNKEEPER';

    /**
     * Role standard.
     *
     * @var string
     */
    const ROLE_STANDARD = 'ROLE_STANDARD';

    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="login", type="text", length=255, nullable=true)
     *
     * @Assert\Length(
     *      min = 10,
     *      max = 64,
     *      minMessage = "login.too_short",
     *      maxMessage = "login.too_long",
     *      allowEmptyString = false
     * )
     */
    private $login;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="text", length=255, nullable=true)
     *
     * @Assert\Length(
     *      min = 10,
     *      max = 64,
     *      minMessage = "password.too_short",
     *      maxMessage = "password.too_long",
     *      allowEmptyString = false
     * )
     */
    private $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="text", length=255, nullable=true)
     *
     * @Assert\Email(
     *     message = "email.not_valid",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * Roles.
     *
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var bool
     *
     * @ORM\Column(name="isBanned", type="boolean", nullable=false)
     */
    private $isbanned;

    public function getIsbanned(): ?bool
    {
        return $this->isbanned;
    }

    public function setIsbanned(bool $isbanned): self
    {
        $this->isbanned = $isbanned;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLogin(): ?string
    {
        return $this->login;
    }

    /**
     * @param string|null $login
     * @return $this
     */
    public function setLogin(?string $login): self
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Getter for the Id.
     *
     * @return int|null Result
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter for the E-mail.
     *
     * @return string|null E-mail
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Setter for the E-mail.
     *
     * @param string $email E-mail
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     *
     * @return string User name
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * Getter for the Roles.
     *
     * @see UserInterface
     *
     * @return array Roles
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_STANDARD
        $roles[] = static::ROLE_STANDARD;

        return array_unique($roles);
    }

    /**
     * Setter for the Roles.
     *
     * @param array $roles Roles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    /**
     * Getter for the Password.
     *
     * @see UserInterface
     *
     * @return string|null Password
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    /**
     * Setter for the Password.
     *
     * @param string $password Password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
