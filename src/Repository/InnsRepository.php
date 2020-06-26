<?php

namespace App\Repository;

use App\Entity\Inns;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Inns|null find($id, $lockMode = null, $lockVersion = null)
 * @method Inns|null findOneBy(array $criteria, array $orderBy = null)
 * @method Inns[]    findAll()
 * @method Inns[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InnsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Inns::class);
    }

    // /**
    //  * @return Inns[] Returns an array of Inns objects
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
    public function findOneBySomeField($value): ?Inns
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
