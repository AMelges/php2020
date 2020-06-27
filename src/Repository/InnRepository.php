<?php

namespace App\Repository;

use App\Entity\Inn;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Inn|null find($id, $lockMode = null, $lockVersion = null)
 * @method Inn|null findOneBy(array $criteria, array $orderBy = null)
 * @method Inn[]    findAll()
 * @method Inn[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InnRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Inn::class);
    }

    // /**
    //  * @return Inn[] Returns an array of Inn objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Inn
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
