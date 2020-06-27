<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Visitors
 *
 * @ORM\Table(name="visitors", indexes={@ORM\Index(name="fk_visitors_tables1_idx", columns={"tableID"}), @ORM\Index(name="fk_visitors_users1_idx", columns={"userID"}), @ORM\Index(name="IDX_7B74A43F9BBAF5FE", columns={"innID"})})
 * @ORM\Entity
 */
class Visitors
{
    /**
     * @var \Inns
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Inns")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="innID", referencedColumnName="ID")
     * })
     */
    private $innid;

    /**
     * @var \Tables
     *
     * @ORM\ManyToOne(targetEntity="Tables")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tableID", referencedColumnName="ID")
     * })
     */
    private $tableid;

    /**
     * @var \Usersdata
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Usersdata")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="userID", referencedColumnName="ID")
     * })
     */
    private $userid;

    public function getInnid(): ?Inns
    {
        return $this->innid;
    }

    public function setInnid(?Inns $innid): self
    {
        $this->innid = $innid;

        return $this;
    }

    public function getTableid(): ?Tables
    {
        return $this->tableid;
    }

    public function setTableid(?Tables $tableid): self
    {
        $this->tableid = $tableid;

        return $this;
    }

    public function getUserid(): ?Usersdata
    {
        return $this->userid;
    }

    public function setUserid(?Usersdata $userid): self
    {
        $this->userid = $userid;

        return $this;
    }


}
