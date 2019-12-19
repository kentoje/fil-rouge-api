<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Velib
 *
 * @ORM\Table(name="velib")
 * @ORM\Entity
 */
class Velib
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
     * @ORM\Column(name="state", type="string", length=50, nullable=false)
     */
    private $state;

    /**
     * @var int
     *
     * @ORM\Column(name="freedock", type="integer", nullable=false)
     */
    private $freedock;

    /**
     * @var bool
     *
     * @ORM\Column(name="credit_card", type="boolean", nullable=false)
     */
    private $creditCard;

    /**
     * @var string
     *
     * @ORM\Column(name="station_name", type="string", length=100, nullable=false)
     */
    private $stationName;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", precision=10, scale=0, nullable=false)
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", precision=10, scale=0, nullable=false)
     */
    private $longitude;

    /**
     * @var int
     *
     * @ORM\Column(name="bike_available", type="integer", nullable=false)
     */
    private $bikeAvailable;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Monuments", mappedBy="idVelib")
     */
    private $idMonument;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idMonument = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getFreedock(): ?int
    {
        return $this->freedock;
    }

    public function setFreedock(int $freedock): self
    {
        $this->freedock = $freedock;

        return $this;
    }

    public function getCreditCard(): ?bool
    {
        return $this->creditCard;
    }

    public function setCreditCard(bool $creditCard): self
    {
        $this->creditCard = $creditCard;

        return $this;
    }

    public function getStationName(): ?string
    {
        return $this->stationName;
    }

    public function setStationName(string $stationName): self
    {
        $this->stationName = $stationName;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getBikeAvailable(): ?int
    {
        return $this->bikeAvailable;
    }

    public function setBikeAvailable(int $bikeAvailable): self
    {
        $this->bikeAvailable = $bikeAvailable;

        return $this;
    }

    /**
     * @return Collection|Monuments[]
     */
    public function getIdMonument(): Collection
    {
        return $this->idMonument;
    }

    public function addIdMonument(Monuments $idMonument): self
    {
        if (!$this->idMonument->contains($idMonument)) {
            $this->idMonument[] = $idMonument;
            $idMonument->addIdVelib($this);
        }

        return $this;
    }

    public function removeIdMonument(Monuments $idMonument): self
    {
        if ($this->idMonument->contains($idMonument)) {
            $this->idMonument->removeElement($idMonument);
            $idMonument->removeIdVelib($this);
        }

        return $this;
    }

}
