<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VelibDistanceMonument
 *
 * @ORM\Table(name="velib_distance_monument", indexes={@ORM\Index(name="velib_distance_monument_monuments0_FK", columns={"id_monuments"}), @ORM\Index(name="velib_distance_monument_velib_FK", columns={"id_velib"})})
 * @ORM\Entity(repositoryClass="App\Repository\VelibDistRepository")
 */
class VelibDistanceMonument
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
     * @var float
     *
     * @ORM\Column(name="distance_km", type="float", precision=10, scale=0, nullable=false)
     */
    private $distanceKm;

    /**
     * @var \Monuments
     *
     * @ORM\ManyToOne(targetEntity="Monuments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_monuments", referencedColumnName="id")
     * })
     */
    private $idMonuments;

    /**
     * @var \Velib
     *
     * @ORM\ManyToOne(targetEntity="Velib")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_velib", referencedColumnName="id")
     * })
     */
    private $idVelib;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDistanceKm(): ?float
    {
        return $this->distanceKm;
    }

    public function setDistanceKm(float $distanceKm): self
    {
        $this->distanceKm = $distanceKm;

        return $this;
    }

    public function getIdMonuments(): ?Monuments
    {
        return $this->idMonuments;
    }

    public function setIdMonuments(?Monuments $idMonuments): self
    {
        $this->idMonuments = $idMonuments;

        return $this;
    }

    public function getIdVelib(): ?Velib
    {
        return $this->idVelib;
    }

    public function setIdVelib(?Velib $idVelib): self
    {
        $this->idVelib = $idVelib;

        return $this;
    }


}
