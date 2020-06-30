<?php
/**
 * Category service.
 */

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

/**
 * Class AdminService.
 */
class AdminService
{
    /**
     * User repository.
     *
     * @var UserRepository
     */
    private $userRepository;

    /**
     * MessageService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $userId
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function banUser(int $userId)
    {
        $user = $this->userRepository->findOneBy(['id' => $userId]);
        $user->setIsbanned(true);
        $this->userRepository->save($user);
    }

    /**
     * @param int $userId
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function unbanUser(int $userId)
    {
        $user = $this->userRepository->findOneBy(['id' => $userId]);
        $user->setIsbanned(false);
        $this->userRepository->save($user);
    }

    /**
     * @param int $userId
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function addAdminRole(int $userId)
    {
        $user = $this->userRepository->findOneBy(['id' => $userId]);
        $user->setRoles([User::ROLE_STANDARD, User::ROLE_ADMIN]);
        $this->userRepository->save($user);
    }

    /**
     * @param int $userId
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function removeAdminRole(int $userId)
    {
        $user = $this->userRepository->findOneBy(['id' => $userId]);
        $user->setRoles([User::ROLE_STANDARD]);
        $this->userRepository->save($user);
    }
}
