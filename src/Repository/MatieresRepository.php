<?php
namespace App\Repository;

use App\Entity\Matieres;  // Match plural
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MatieresRepository extends ServiceEntityRepository  // Change to MatieresRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Matieres::class);
    }
}
