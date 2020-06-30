<?php
/**
 * Category service.
 */

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;

/**
 * Class AdminService.
 */
class AdminService
{
    /**
     * User repository.
     *
     * @var \App\Repository\UserRepository
     */
    private $userRepository;

    /**
     * MessageService constructor.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function banUser(int $userId)
    {
        $user = $this->userRepository->findOneBy(['id' => $userId]);
        $user->setIsbanned(true);
        $this->userRepository->save($user);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function unbanUser(int $userId)
    {
        $user = $this->userRepository->findOneBy(['id' => $userId]);
        $user->setIsbanned(false);
        $this->userRepository->save($user);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addAdminRole(int $userId)
    {
        $user = $this->userRepository->findOneBy(['id' => $userId]);
        $user->setRoles([User::ROLE_STANDARD, User::ROLE_ADMIN]);
        $this->userRepository->save($user);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function removeAdminRole(int $userId)
    {
        $user = $this->userRepository->findOneBy(['id' => $userId]);
        $user->setRoles([User::ROLE_STANDARD]);
        $this->userRepository->save($user);
    }
}
