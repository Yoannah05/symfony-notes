<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
class Inscriptions
{
    #[ORM\Id] 
    #[ORM\Column]
    #[ORM\GeneratedValue]
    private ?int $id_inscription = null;

    /**
     * @var Collection<int, Etudiant>
     */
    #[ORM\ManyToMany(targetEntity: Etudiants::class)]
    private Collection $id_etudiant;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_inscription = null;

    /**
     * @var Collection<int, Semestre>
     */
    #[ORM\ManyToMany(targetEntity: Semestres::class)]
    private Collection $id_semestre;

    public function __construct()
    {
        $this->id_etudiant = new ArrayCollection();
        $this->id_semestre = new ArrayCollection();
    }

    public function getIdInscription(): ?int
    {
        return $this->id_inscription;
    }

    public function setIdInscription(int $id_inscription): static
    {
        $this->id_inscription = $id_inscription;

        return $this;
    }

    /**
     * @return Collection<int, Etudiant>
     */
    public function getIdEtudiant(): Collection
    {
        return $this->id_etudiant;
    }

    public function addIdEtudiant(Etudiants $idEtudiant): static
    {
        if (!$this->id_etudiant->contains($idEtudiant)) {
            $this->id_etudiant->add($idEtudiant);
        }

        return $this;
    }

    public function removeIdEtudiant(Etudiants $idEtudiant): static
    {
        $this->id_etudiant->removeElement($idEtudiant);

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->date_inscription;
    }

    public function setDateInscription(\DateTimeInterface $date_inscription): static
    {
        $this->date_inscription = $date_inscription;

        return $this;
    }

    /**
     * @return Collection<int, Semestre>
     */
    public function getIdSemestre(): Collection
    {
        return $this->id_semestre;
    }

    public function addIdSemestre(Semestres $idSemestre): static
    {
        if (!$this->id_semestre->contains($idSemestre)) {
            $this->id_semestre->add($idSemestre);
        }

        return $this;
    }

    public function removeIdSemestre(Semestres $idSemestre): static
    {
        $this->id_semestre->removeElement($idSemestre);

        return $this;
    }
}
