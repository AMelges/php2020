<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Messages
 *
 * @ORM\Table(name="messages", uniqueConstraints={@ORM\UniqueConstraint(name="ID_UNIQUE", columns={"ID"})}, indexes={@ORM\Index(name="fk_messages_users1_idx", columns={"senderID"}), @ORM\Index(name="fk_messages_tables1_idx", columns={"tableID"})})
 * @ORM\Entity
 */
class Messages
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var string|null
     *
     * @ORM\Column(name="content", type="text", length=255, nullable=true)
     */
    private $content;

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
     *   @ORM\JoinColumn(name="senderID", referencedColumnName="ID")
     * })
     */
    private $senderid;


}
