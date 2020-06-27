<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inn
 *
 * @ORM\Table(name="inns", uniqueConstraints={@ORM\UniqueConstraint(name="innkeeperID_UNIQUE", columns={"innkeeperID"}), @ORM\UniqueConstraint(name="name_UNIQUE", columns={"name"})}, indexes={@ORM\Index(name="fk_inns_realms1_idx", columns={"realmID"}), @ORM\Index(name="fk_inns_users1_idx", columns={"innkeeperID"})})
 * @ORM\Entity(repositoryClass="App\Repository\InnRepository")
 */
class Inn
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
     * @var \Realm
     *
     * @ORM\ManyToOne(targetEntity="Realm")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="realmID", referencedColumnName="ID")
     * })
     */
    private $realmid;

    /**
     * @var \UserData
     *
     * @ORM\ManyToOne(targetEntity="UserData")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="innkeeperID", referencedColumnName="ID")
     * })
     */
    private $innkeeperid;


}
