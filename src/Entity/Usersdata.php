<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Usersdata
 *
 * @ORM\Table(name="usersdata", uniqueConstraints={@ORM\UniqueConstraint(name="name_UNIQUE", columns={"name"}), @ORM\UniqueConstraint(name="ID_UNIQUE", columns={"ID"}), @ORM\UniqueConstraint(name="credentialsID_UNIQUE", columns={"userID"})}, indexes={@ORM\Index(name="fk_users_credentials_idx", columns={"userID"})})
 * @ORM\Entity
 */
class Usersdata
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="lastLogin", type="datetime", nullable=true)
     */
    private $lastlogin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="text", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="avatarURL", type="text", length=65535, nullable=true)
     */
    private $avatarurl;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="userID", referencedColumnName="ID")
     * })
     */
    private $userid;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Clans", mappedBy="userid")
     */
    private $clanid;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->clanid = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastlogin(): ?\DateTimeInterface
    {
        return $this->lastlogin;
    }

    public function setLastlogin(?\DateTimeInterface $lastlogin): self
    {
        $this->lastlogin = $lastlogin;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAvatarurl(): ?string
    {
        return $this->avatarurl;
    }

    public function setAvatarurl(?string $avatarurl): self
    {
        $this->avatarurl = $avatarurl;

        return $this;
    }

    public function getUserid(): ?Users
    {
        return $this->userid;
    }

    public function setUserid(?Users $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * @return Collection|Clans[]
     */
    public function getClanid(): Collection
    {
        return $this->clanid;
    }

    public function addClanid(Clans $clanid): self
    {
        if (!$this->clanid->contains($clanid)) {
            $this->clanid[] = $clanid;
            $clanid->addUserid($this);
        }

        return $this;
    }

    public function removeClanid(Clans $clanid): self
    {
        if ($this->clanid->contains($clanid)) {
            $this->clanid->removeElement($clanid);
            $clanid->removeUserid($this);
        }

        return $this;
    }

}
