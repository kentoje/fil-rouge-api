<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ElectricterminalDistanceMonument
 *
 * @ORM\Table(name="electricterminal_distance_monument", indexes={@ORM\Index(name="electricterminal_distance_monument_monuments0_FK", columns={"id_monuments"}), @ORM\Index(name="electricterminal_distance_monument_electricterminal_FK", columns={"id_electricterminal"})})
 * @ORM\Entity
 */
class ElectricterminalDistanceMonument
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
     * @var \Electricterminal
     *
     * @ORM\ManyToOne(targetEntity="Electricterminal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_electricterminal", referencedColumnName="id")
     * })
     */
    private $idElectricterminal;

    /**
     * @var \Monuments
     *
     * @ORM\ManyToOne(targetEntity="Monuments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_monuments", referencedColumnName="id")
     * })
     */
    private $idMonuments;

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

    public function getIdElectricterminal(): ?Electricterminal
    {
        return $this->idElectricterminal;
    }

    public function setIdElectricterminal(?Electricterminal $idElectricterminal): self
    {
        $this->idElectricterminal = $idElectricterminal;

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


}
