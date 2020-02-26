<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecordsWaste
 *
 * @ORM\Table(name="records_waste")
 * @ORM\Entity
 */
class RecordsWaste
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="tons", type="integer", nullable=false)
     */
    private $tons;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_recyclabe", type="boolean", nullable=false)
     */
    private $isRecyclabe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTons(): ?int
    {
        return $this->tons;
    }

    public function setTons(int $tons): self
    {
        $this->tons = $tons;

        return $this;
    }

    public function getIsRecyclabe(): ?bool
    {
        return $this->isRecyclabe;
    }

    public function setIsRecyclabe(bool $isRecyclabe): self
    {
        $this->isRecyclabe = $isRecyclabe;

        return $this;
    }


}
