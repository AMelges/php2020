<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tables
 *
 * @ORM\Table(name="tables", uniqueConstraints={@ORM\UniqueConstraint(name="ID_UNIQUE", columns={"ID"})}, indexes={@ORM\Index(name="fk_tables_inns1_idx", columns={"innID"})})
 * @ORM\Entity
 */
class Tables
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
     * @var \Inns
     *
     * @ORM\ManyToOne(targetEntity="Inns")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="innID", referencedColumnName="ID")
     * })
     */
    private $innid;


}
