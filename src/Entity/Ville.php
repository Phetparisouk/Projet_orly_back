<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\VilleRepository")
 */
class Ville
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_ville;

    /**
     * @ORM\Column(type="integer")
     */
    private $budget;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TypeVoyage", inversedBy="villes")
     * @ORM\JoinTable(name="ville_type_voyage")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pays", inversedBy="villes")
     */
    private $pays;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Temperature", mappedBy="ville")
     */
    private $temperature;

    public function __construct()
    {
        $this->type = new ArrayCollection();
        $this->temperature = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomVille(): ?string
    {
        return $this->nom_ville;
    }

    public function setNomVille(string $nom_ville): self
    {
        $this->nom_ville = $nom_ville;

        return $this;
    }

    public function getBudget(): ?int
    {
        return $this->budget;
    }

    public function setBudget(int $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * @return Collection|TypeVoyage[]
     */
    public function getType(): Collection
    {
        return $this->type;
    }

    public function addType(TypeVoyage $type): self
    {
        if (!$this->type->contains($type)) {
            $this->type[] = $type;
        }

        return $this;
    }

    public function removeType(TypeVoyage $type): self
    {
        if ($this->type->contains($type)) {
            $this->type->removeElement($type);
        }

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection|Temperature[]
     */
    public function getTemperature(): Collection
    {
        return $this->temperature;
    }

    public function addTemperature(Temperature $temperature): self
    {
        if (!$this->temperature->contains($temperature)) {
            $this->temperature[] = $temperature;
            $temperature->setVille($this);
        }

        return $this;
    }

    public function removeTemperature(Temperature $temperature): self
    {
        if ($this->temperature->contains($temperature)) {
            $this->temperature->removeElement($temperature);
            // set the owning side to null (unless already changed)
            if ($temperature->getVille() === $this) {
                $temperature->setVille(null);
            }
        }

        return $this;
    }
}
