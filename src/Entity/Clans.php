<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clans
 *
 * @ORM\Table(name="clans", indexes={@ORM\Index(name="fk_clans_users1_idx", columns={"chieftainID"})})
 * @ORM\Entity
 */
class Clans
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
     * @var \Usersdata
     *
     * @ORM\ManyToOne(targetEntity="Usersdata")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="chieftainID", referencedColumnName="ID")
     * })
     */
    private $chieftainid;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Usersdata", inversedBy="clanid")
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

}
