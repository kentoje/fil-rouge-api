<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TrilibDistanceMonument
 *
 * @ORM\Table(name="trilib_distance_monument", indexes={@ORM\Index(name="trilib_distance_monument_monuments0_FK", columns={"id_monuments"}), @ORM\Index(name="trilib_distance_monument_trilib_FK", columns={"id_trilib"})})
 * @ORM\Entity
 */
class TrilibDistanceMonument
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
     * @var \Trilib
     *
     * @ORM\ManyToOne(targetEntity="Trilib")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_trilib", referencedColumnName="id")
     * })
     */
    private $idTrilib;

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

    public function getIdTrilib(): ?Trilib
    {
        return $this->idTrilib;
    }

    public function setIdTrilib(?Trilib $idTrilib): self
    {
        $this->idTrilib = $idTrilib;

        return $this;
    }


}
