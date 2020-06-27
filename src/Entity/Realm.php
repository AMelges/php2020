<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Realm
 *
 * @ORM\Table(name="realms", uniqueConstraints={@ORM\UniqueConstraint(name="kingID_UNIQUE", columns={"kingID"})}, indexes={@ORM\Index(name="fk_realms_users1_idx", columns={"kingID"})})
 * @ORM\Entity(repositoryClass="App\Repository\RealmRepository")
 */
class Realm
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
     * @ORM\Column(name="name", type="text", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="crestURL", type="text", length=65535, nullable=true)
     */
    private $cresturl;

    /**
     * @var \UserData
     *
     * @ORM\ManyToOne(targetEntity="UserData")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="kingID", referencedColumnName="ID")
     * })
     */
    private $kingid;


}
