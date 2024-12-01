<?php
namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteRepository::class)]
class Notes
{
    #[ORM\Id] 
    #[ORM\Column]
    #[ORM\GeneratedValue]
    private ?int $id_note = null;

    #[ORM\ManyToOne(targetEntity: Etudiants::class)]
    #[ORM\JoinColumn(name: "id_etudiant", referencedColumnName: "id_etudiant", nullable: false)]
    private ?Etudiants $etudiant = null;

    #[ORM\ManyToOne(targetEntity: Matieres::class)]
    #[ORM\JoinColumn(name: "id_matiere", referencedColumnName: "id_matiere", nullable: false)]
    private ?Matieres $matiere = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: 2, nullable: true)]
    private ?string $valeur = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $session = null;

    public function getIdNote(): ?int
    {
        return $this->id_note;
    }

    public function setIdNote(int $id_note): static
    {
        $this->id_note = $id_note;
        return $this;
    }

    public function getEtudiant(): ?Etudiants
    {
        return $this->etudiant;
    }

    public function setEtudiant(Etudiants $etudiant): static
    {
        $this->etudiant = $etudiant;
        return $this;
    }

    public function getMatiere(): ?Matieres
    {
        return $this->matiere;
    }

    public function setMatiere(Matieres $matiere): static
    {
        $this->matiere = $matiere;
        return $this;
    }

    public function getValeur(): ?string
    {
        return $this->valeur;
    }

    public function setValeur(?string $valeur): static
    {
        $this->valeur = $valeur;
        return $this;
    }

    public function getSession(): ?\DateTimeInterface
    {
        return $this->session;
    }

    public function setSession(\DateTimeInterface $session): static
    {
        $this->session = $session;
        return $this;
    }
}
