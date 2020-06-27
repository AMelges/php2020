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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

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

    public function getSenderid(): ?Usersdata
    {
        return $this->senderid;
    }

    public function setSenderid(?Usersdata $senderid): self
    {
        $this->senderid = $senderid;

        return $this;
    }


}
