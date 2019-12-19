<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Monuments
 *
 * @ORM\Table(name="monuments")
 * @ORM\Entity
 */
class Monuments
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
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", precision=10, scale=0, nullable=false)
     */
    private $longitude;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", precision=10, scale=0, nullable=false)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=100, nullable=false)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=50, nullable=false)
     */
    private $city;

    /**
     * @var int
     *
     * @ORM\Column(name="zipcode", type="integer", nullable=false)
     */
    private $zipcode;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Trilib", mappedBy="idMonument")
     */
    private $idTrilib;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Electricterminal", inversedBy="idMonument")
     * @ORM\JoinTable(name="eloigner",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_monument", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_electricterminal", referencedColumnName="id")
     *   }
     * )
     */
    private $idElectricterminal;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Trimobile", inversedBy="idMonument")
     * @ORM\JoinTable(name="espacer",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_monument", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_trimobile", referencedColumnName="id")
     *   }
     * )
     */
    private $idTrimobile;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Velib", inversedBy="idMonument")
     * @ORM\JoinTable(name="etre",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_monument", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_velib", referencedColumnName="id")
     *   }
     * )
     */
    private $idVelib;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idTrilib = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idElectricterminal = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idTrimobile = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idVelib = new \Doctrine\Common\Collections\ArrayCollection();
    }

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

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

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

    public function getZipcode(): ?int
    {
        return $this->zipcode;
    }

    public function setZipcode(int $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * @return Collection|Trilib[]
     */
    public function getIdTrilib(): Collection
    {
        return $this->idTrilib;
    }

    public function addIdTrilib(Trilib $idTrilib): self
    {
        if (!$this->idTrilib->contains($idTrilib)) {
            $this->idTrilib[] = $idTrilib;
            $idTrilib->addIdMonument($this);
        }

        return $this;
    }

    public function removeIdTrilib(Trilib $idTrilib): self
    {
        if ($this->idTrilib->contains($idTrilib)) {
            $this->idTrilib->removeElement($idTrilib);
            $idTrilib->removeIdMonument($this);
        }

        return $this;
    }

    /**
     * @return Collection|Electricterminal[]
     */
    public function getIdElectricterminal(): Collection
    {
        return $this->idElectricterminal;
    }

    public function addIdElectricterminal(Electricterminal $idElectricterminal): self
    {
        if (!$this->idElectricterminal->contains($idElectricterminal)) {
            $this->idElectricterminal[] = $idElectricterminal;
        }

        return $this;
    }

    public function removeIdElectricterminal(Electricterminal $idElectricterminal): self
    {
        if ($this->idElectricterminal->contains($idElectricterminal)) {
            $this->idElectricterminal->removeElement($idElectricterminal);
        }

        return $this;
    }

    /**
     * @return Collection|Trimobile[]
     */
    public function getIdTrimobile(): Collection
    {
        return $this->idTrimobile;
    }

    public function addIdTrimobile(Trimobile $idTrimobile): self
    {
        if (!$this->idTrimobile->contains($idTrimobile)) {
            $this->idTrimobile[] = $idTrimobile;
        }

        return $this;
    }

    public function removeIdTrimobile(Trimobile $idTrimobile): self
    {
        if ($this->idTrimobile->contains($idTrimobile)) {
            $this->idTrimobile->removeElement($idTrimobile);
        }

        return $this;
    }

    /**
     * @return Collection|Velib[]
     */
    public function getIdVelib(): Collection
    {
        return $this->idVelib;
    }

    public function addIdVelib(Velib $idVelib): self
    {
        if (!$this->idVelib->contains($idVelib)) {
            $this->idVelib[] = $idVelib;
        }

        return $this;
    }

    public function removeIdVelib(Velib $idVelib): self
    {
        if ($this->idVelib->contains($idVelib)) {
            $this->idVelib->removeElement($idVelib);
        }

        return $this;
    }

}
