<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TrimobileDistanceMonument
 *
 * @ORM\Table(name="trimobile_distance_monument", indexes={@ORM\Index(name="trimobile_distance_monument_monuments0_FK", columns={"id_monuments"}), @ORM\Index(name="trimobile_distance_monument_trimobile_FK", columns={"id_trimobile"})})
 * @ORM\Entity(repositoryClass="App\Repository\TrimobileDistRepository")
 */
class TrimobileDistanceMonument
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
     * @var \Trimobile
     *
     * @ORM\ManyToOne(targetEntity="Trimobile")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_trimobile", referencedColumnName="id")
     * })
     */
    private $idTrimobile;

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

    public function getIdTrimobile(): ?Trimobile
    {
        return $this->idTrimobile;
    }

    public function setIdTrimobile(?Trimobile $idTrimobile): self
    {
        $this->idTrimobile = $idTrimobile;

        return $this;
    }


}
