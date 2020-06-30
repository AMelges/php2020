<?php
/**
 * Category service.
 */

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;

/**
 * Class RegisterService.
 */
class RegisterService
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
    public function addUser(User $user)
    {
        $user->setRoles([User::ROLE_STANDARD]);
        $user->setPassword(
            $this->userRepository->passwordEncoder->encodePassword(
               $user,
               $user->getPassword()
            )
        );
        $this->userRepository->save($user);
    }
}
