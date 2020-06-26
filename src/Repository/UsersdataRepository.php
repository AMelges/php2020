<?php

namespace App\Repository;

use App\Entity\Usersdata;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Usersdata|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usersdata|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usersdata[]    findAll()
 * @method Usersdata[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersdataRepository extends ServiceEntityRepository
{
    /**
     * UsersdataRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usersdata::class);
    }

    /**
     * Query all records.
     *
     * @return \Doctrine\ORM\QueryBuilder Query builder
     */
    public function queryAll(): QueryBuilder
    {
        return $this->getOrCreateQueryBuilder()
            ->orderBy('userdata.ID', 'DESC');
    }

    /**
     * Get or create new query builder.
     *
     * @param \Doctrine\ORM\QueryBuilder|null $queryBuilder Query builder
     *
     * @return \Doctrine\ORM\QueryBuilder Query builder
     */
    private function getOrCreateQueryBuilder(QueryBuilder $queryBuilder = null): QueryBuilder
    {
        return $queryBuilder ?? $this->createQueryBuilder('usersdata');
    }

    /**
     * Save record.
     *
     * @param \App\Entity\Usersdata $usersdata Usersdata entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Usersdata $usersdata): void
    {
        $this->_em->persist($usersdata);
        $this->_em->flush($usersdata);
    }
}
