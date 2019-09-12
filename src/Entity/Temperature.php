<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TemperatureRepository")
 */
class Temperature
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ville", inversedBy="villes")
     * @ORM\JoinColumn(name="ville_id", referencedColumnName="id")
     */
    private $ville;

    /**
     * @ORM\Column(type="float")
     */
    private $degre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mois;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDegre(): ?float
    {
        return $this->degre;
    }

    public function setDegre(float $degre): self
    {
        $this->degre = $degre;

        return $this;
    }

    public function getMois(): ?string
    {
        return $this->mois;
    }

    public function setMois(string $mois): self
    {
        $this->mois = $mois;

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): self
    {
        $this->ville = ville;

        return $this;
    }
}
