<?php

namespace App\Repository;

use App\Entity\Realms;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Realms|null find($id, $lockMode = null, $lockVersion = null)
 * @method Realms|null findOneBy(array $criteria, array $orderBy = null)
 * @method Realms[]    findAll()
 * @method Realms[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RealmsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Realms::class);
    }

    // /**
    //  * @return Realms[] Returns an array of Realms objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Realms
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
