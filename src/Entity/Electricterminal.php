<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Electricterminal
 *
 * @ORM\Table(name="electricterminal")
 * @ORM\Entity(repositoryClass="App\Repository\ElectricterminalRepository")
 */
class Electricterminal
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
     * @ORM\Column(name="schedule", type="string", length=50, nullable=false)
     */
    private $schedule;

    /**
     * @var string
     *
     * @ORM\Column(name="aftersales_phone", type="string", length=50, nullable=false)
     */
    private $aftersalesPhone;

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
     * @var string
     *
     * @ORM\Column(name="electric_type", type="string", length=50, nullable=false)
     */
    private $electricType;

    /**
     * @var string
     *
     * @ORM\Column(name="connector_type", type="string", length=100, nullable=false)
     */
    private $connectorType;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=50, nullable=false)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=50, nullable=false)
     */
    private $address;

    /**
     * @var int
     *
     * @ORM\Column(name="zipcode", type="integer", nullable=false)
     */
    private $zipcode;

    /**
     * @var float
     *
     * @ORM\Column(name="watt", type="float", precision=10, scale=0, nullable=false)
     */
    private $watt;

    /**
     * @var string
     *
     * @ORM\Column(name="station_name", type="string", length=100, nullable=false)
     */
    private $stationName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSchedule(): ?string
    {
        return $this->schedule;
    }

    public function setSchedule(string $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getAftersalesPhone(): ?string
    {
        return $this->aftersalesPhone;
    }

    public function setAftersalesPhone(string $aftersalesPhone): self
    {
        $this->aftersalesPhone = $aftersalesPhone;

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

    public function getElectricType(): ?string
    {
        return $this->electricType;
    }

    public function setElectricType(string $electricType): self
    {
        $this->electricType = $electricType;

        return $this;
    }

    public function getConnectorType(): ?string
    {
        return $this->connectorType;
    }

    public function setConnectorType(string $connectorType): self
    {
        $this->connectorType = $connectorType;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getZipcode(): ?int
    {
        return $this->zipcode;
    }

    public function setZipcode(int $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getWatt(): ?float
    {
        return $this->watt;
    }

    public function setWatt(float $watt): self
    {
        $this->watt = $watt;

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


}
