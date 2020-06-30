<?php
/**
 * UserDataRepository
 */

namespace App\Repository;

use App\Entity\UserData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * UserDataRepository
 *
 * @method UserData|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserData|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserData[]    findAll()
 * @method UserData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserDataRepository extends ServiceEntityRepository
{

    /**
     * Constructor
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserData::class);
    }
}
