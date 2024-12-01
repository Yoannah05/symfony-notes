<?php

namespace App\Entity;

use App\Repository\EtudiantsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantsRepository::class)]

class Etudiants
{
    #[ORM\Id] 
    #[ORM\Column]
    #[ORM\GeneratedValue]
    private ?int $id_etudiant = null;

    #[ORM\Column(length: 255)]
    private ?string $identifiant = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dtn = null;

    #[ORM\OneToMany(mappedBy: 'etudiant', targetEntity: Notes::class)]
    private Collection $notes;

    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function getIdEtudiant(): ?int
    {
        return $this->id_etudiant;
    }

    public function setIdEtudiant(int $id_etudiant): static
    {
        $this->id_etudiant = $id_etudiant;

        return $this;
    }

    public function getIdentifiant(): ?string
    {
        return $this->identifiant;
    }

    public function setIdentifiant(string $identifiant): static
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDtn(): ?\DateTimeInterface
    {
        return $this->dtn;
    }

    public function setDtn(\DateTimeInterface $dtn): static
    {
        $this->dtn = $dtn;

        return $this;
    }
}
