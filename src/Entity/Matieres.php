<?php

namespace App\Entity;

use App\Repository\MatieresRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;


#[ORM\Entity(repositoryClass: MatieresRepository::class)]
#[ORM\Table(name: "matieres")]
#[ApiResource]

class Matieres
{
    #[ORM\Id] 
    #[ORM\Column]
    #[ORM\GeneratedValue]
    private ?int $id_matiere = null;

    #[ORM\Column(length: 20)]
    private ?string $code = null;

    #[ORM\Column]
    private ?int $credit = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: "id_semestre", referencedColumnName: "id_semestre", nullable: false)]
    private ?Semestres $id_semestre = null;

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getIdMatiere(): ?int
    {
        return $this->id_matiere;
    }

    public function setIdMatiere(int $id_matiere): static
    {
        $this->id_matiere = $id_matiere;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getCredit(): ?int
    {
        return $this->credit;
    }

    public function setCredit(int $credit): static
    {
        $this->credit = $credit;

        return $this;
    }

    public function getSemestre(): ?Semestres
    {
        return $this->id_semestre;
    }

    public function setIdSemestre(?Semestres $id_semestre): static
    {
        $this->id_semestre = $id_semestre;

        return $this;
    }
}
