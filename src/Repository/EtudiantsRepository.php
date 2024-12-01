<?php

namespace App\Repository;

use App\Entity\Etudiants;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Etudiants>
 */
class EtudiantsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etudiants::class);
    }

    public function getStudentsWithMoyenneAndNotesL1($semestres)
    {
        $qb = $this->createQueryBuilder('e')
            ->select('e.id_etudiant', 'e.identifiant')
            ->addSelect('SUM(n.valeur * m.credit) / SUM(m.credit) AS moyenne')
            ->addSelect('m.code AS matiere_code', 'MAX(n.valeur) AS note') 
            ->leftJoin('e.notes', 'n')
            ->leftJoin('n.matiere', 'm')
            ->leftJoin('m.id_semestre', 's')
            ->where('s IN (:semestres)')
            ->groupBy('e.id_etudiant', 'm.id_matiere') 
            ->orderBy('moyenne', 'DESC') 
            ->setParameter('semestres', $semestres);
    
        $results = $qb->getQuery()->getResult();
        
        $students = [];
        foreach ($results as $result) {
            $studentId = $result['id_etudiant'];
    
            // Initialize student record if not set
            if (!isset($students[$studentId])) {
                $students[$studentId] = [
                    'identifiant' => $result['identifiant'],
                    'moyenne' => $result['moyenne'],
                    'matieres' => [],
                ];
            }
    
            // Add subject information
            $subjectCode = $result['matiere_code'];
            if (!isset($students[$studentId]['matieres'][$subjectCode])) {
                $students[$studentId]['matieres'][$subjectCode] = [
                    'code' => $result['matiere_code'],
                    'note' => $result['note'],
                ];
            }
        }
    
        return array_values($students);
    }
    


    public function findByIdentifiant(string $identifiant): ?Etudiants
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.identifiant = :identifiant')
            ->setParameter('identifiant', $identifiant)
            ->getQuery()
            ->getOneOrNullResult();
    }

    //    /**
    //     * @return Etudiant[] Returns an array of Etudiant objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Etudiant
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
