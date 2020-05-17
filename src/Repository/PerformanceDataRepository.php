<?php

namespace App\Repository;

use App\Entity\PerformanceData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PerformanceData|null find($id, $lockMode = null, $lockVersion = null)
 * @method PerformanceData|null findOneBy(array $criteria, array $orderBy = null)
 * @method PerformanceData[]    findAll()
 * @method PerformanceData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerformanceDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PerformanceData::class);
    }

    // /**
    //  * @return PerformanceData[] Returns an array of PerformanceData objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PerformanceData
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
