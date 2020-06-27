<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Visitor
 *
 * @ORM\Table(name="visitors", indexes={@ORM\Index(name="fk_visitors_users1_idx", columns={"userID"}), @ORM\Index(name="fk_visitors_tables1_idx", columns={"tableID"}), @ORM\Index(name="IDX_7B74A43F9BBAF5FE", columns={"innID"})})
 * @ORM\Entity(repositoryClass="App\Repository\VisitorRepository")
 */
class Visitor
{
    /**
     * @var \Inn
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Inn")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="innID", referencedColumnName="ID")
     * })
     */
    private $innid;

    /**
     * @var \Table
     *
     * @ORM\ManyToOne(targetEntity="Table")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tableID", referencedColumnName="ID")
     * })
     */
    private $tableid;

    /**
     * @var \UserData
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="UserData")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="userID", referencedColumnName="ID")
     * })
     */
    private $userid;

    public function getInnid(): ?Inn
    {
        return $this->innid;
    }

    public function setInnid(?Inn $innid): self
    {
        $this->innid = $innid;

        return $this;
    }

    public function getTableid(): ?Table
    {
        return $this->tableid;
    }

    public function setTableid(?Table $tableid): self
    {
        $this->tableid = $tableid;

        return $this;
    }

    public function getUserid(): ?UserData
    {
        return $this->userid;
    }

    public function setUserid(?UserData $userid): self
    {
        $this->userid = $userid;

        return $this;
    }


}
