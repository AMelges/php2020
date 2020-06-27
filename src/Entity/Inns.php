<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inns
 *
 * @ORM\Table(name="inns", uniqueConstraints={@ORM\UniqueConstraint(name="innkeeperID_UNIQUE", columns={"innkeeperID"}), @ORM\UniqueConstraint(name="name_UNIQUE", columns={"name"})}, indexes={@ORM\Index(name="fk_inns_users1_idx", columns={"innkeeperID"}), @ORM\Index(name="fk_inns_realms1_idx", columns={"realmID"})})
 * @ORM\Entity
 */
class Inns
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
     * @var string|null
     *
     * @ORM\Column(name="signboardURL", type="text", length=65535, nullable=true)
     */
    private $signboardurl;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", length=255, nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="capacity", type="integer", nullable=false, options={"default"="1"})
     */
    private $capacity = '1';

    /**
     * @var \Realms
     *
     * @ORM\ManyToOne(targetEntity="Realms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="realmID", referencedColumnName="ID")
     * })
     */
    private $realmid;

    /**
     * @var \Usersdata
     *
     * @ORM\ManyToOne(targetEntity="Usersdata")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="innkeeperID", referencedColumnName="ID")
     * })
     */
    private $innkeeperid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSignboardurl(): ?string
    {
        return $this->signboardurl;
    }

    public function setSignboardurl(?string $signboardurl): self
    {
        $this->signboardurl = $signboardurl;

        return $this;
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

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getRealmid(): ?Realms
    {
        return $this->realmid;
    }

    public function setRealmid(?Realms $realmid): self
    {
        $this->realmid = $realmid;

        return $this;
    }

    public function getInnkeeperid(): ?Usersdata
    {
        return $this->innkeeperid;
    }

    public function setInnkeeperid(?Usersdata $innkeeperid): self
    {
        $this->innkeeperid = $innkeeperid;

        return $this;
    }


}
