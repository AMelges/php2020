<?php

namespace App\Entity;

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

}
