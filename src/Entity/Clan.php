<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Clan
 *
 * @ORM\Table(name="clans", indexes={@ORM\Index(name="fk_clans_users1_idx", columns={"chieftainID"})})
 * @ORM\Entity(repositoryClass="App\Repository\ClanRepository")
 */
class Clan
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
     * @var string
     *
     * @ORM\Column(name="name", type="text", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bannerURL", type="text", length=65535, nullable=true)
     */
    private $bannerurl;

    /**
     * @var \UserData
     *
     * @ORM\ManyToOne(targetEntity="UserData")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="chieftainID", referencedColumnName="ID")
     * })
     */
    private $chieftainid;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="UserData", inversedBy="clanid")
     * @ORM\JoinTable(name="clansmen",
     *   joinColumns={
     *     @ORM\JoinColumn(name="clanID", referencedColumnName="ID")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="userID", referencedColumnName="ID")
     *   }
     * )
     */
    private $userid;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userid = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBannerurl(): ?string
    {
        return $this->bannerurl;
    }

    public function setBannerurl(?string $bannerurl): self
    {
        $this->bannerurl = $bannerurl;

        return $this;
    }

    public function getChieftainid(): ?UserData
    {
        return $this->chieftainid;
    }

    public function setChieftainid(?UserData $chieftainid): self
    {
        $this->chieftainid = $chieftainid;

        return $this;
    }

    /**
     * @return Collection|UserData[]
     */
    public function getUserid(): Collection
    {
        return $this->userid;
    }

    public function addUserid(UserData $userid): self
    {
        if (!$this->userid->contains($userid)) {
            $this->userid[] = $userid;
        }

        return $this;
    }

    public function removeUserid(UserData $userid): self
    {
        if ($this->userid->contains($userid)) {
            $this->userid->removeElement($userid);
        }

        return $this;
    }

}
