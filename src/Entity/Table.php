<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Table
 *
 * @ORM\Table(name="tables", uniqueConstraints={@ORM\UniqueConstraint(name="ID_UNIQUE", columns={"ID"})}, indexes={@ORM\Index(name="fk_tables_inns1_idx", columns={"innID"})})
 * @ORM\Entity(repositoryClass="App\Repository\TableRepository")
 */
class Table
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
     * @var int
     *
     * @ORM\Column(name="capacity", type="integer", nullable=false, options={"default"="1"})
     */
    private $capacity = '1';

    /**
     * @var string|null
     *
     * @ORM\Column(name="topic", type="text", length=255, nullable=true)
     */
    private $topic;

    /**
     * @var \Inn
     *
     * @ORM\ManyToOne(targetEntity="Inn")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="innID", referencedColumnName="ID")
     * })
     */
    private $innid;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTopic(): ?string
    {
        return $this->topic;
    }

    public function setTopic(?string $topic): self
    {
        $this->topic = $topic;

        return $this;
    }

    public function getInnid(): ?Inn
    {
        return $this->innid;
    }

    public function setInnid(?Inn $innid): self
    {
        $this->innid = $innid;

        return $this;
    }


}
