<?php

namespace App\Entity;

use App\Repository\SemestresRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SemestresRepository::class)]
class Semestres
{
    #[ORM\Id] 
    #[ORM\Column]
    #[ORM\GeneratedValue]
    private ?int $id_semestre = null;

    #[ORM\Column]
    private ?int $nom = null;

    public function getIdSemestre(): ?int
    {
        return $this->id_semestre;
    }

    public function setIdSemestre(int $id_semestre): static
    {
        $this->id_semestre = $id_semestre;

        return $this;
    }

    public function getNom(): ?int
    {
        return $this->nom;
    }

    public function setNom(int $nom): static
    {
        $this->nom = $nom;

        return $this;
    }
}
