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


}
