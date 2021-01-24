<?php

namespace App\Repository;

use App\Entity\Yields;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Yields|null find($id, $lockMode = null, $lockVersion = null)
 * @method Yields|null findOneBy(array $criteria, array $orderBy = null)
 * @method Yields[]    findAll()
 * @method Yields[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class YieldsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Yields::class);
    }

    // /**
    //  * @return Yields[] Returns an array of Yields objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('y.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Yields
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
