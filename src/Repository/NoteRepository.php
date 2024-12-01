<?php

namespace App\Repository;

use App\Entity\Notes;
use App\Entity\Etudiants;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Notes>
 */
class NoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Notes::class);
    }

    public function findNotesByStudentAndSemesters(Etudiants $student, array $semesters): array
    {
        return $this->createQueryBuilder('n')
        ->leftJoin('n.matiere', 'm')  // On fait une jointure gauche avec la matière
        ->leftJoin('m.id_semestre', 's') // Jointure avec le semestre
        ->where('n.etudiant = :student')  // Condition sur l'étudiant
        ->andWhere('s.nom IN (:semesters)')  // Condition sur les semestres
        ->setParameter('student', $student)
        ->setParameter('semesters', $semesters)
        ->addSelect('m')  
        ->addSelect('n')  
        ->getQuery()
        ->getResult();
            // ->join('n.matiere', 'm')
            // ->join('m.id_semestre', 's')
            // ->where('n.etudiant = :student')
            // ->andWhere('s.nom IN (:semesters)')
            // ->setParameter('student', $student)
            // ->setParameter('semesters', $semesters)
            // ->getQuery()
            // ->getResult();
    }

//    /**
//     * @return Note[] Returns an array of Note objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Note
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
