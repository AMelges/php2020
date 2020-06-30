<?php
/**
 * Category service.
 */

namespace App\Service;

use App\Entity\Message;
use App\Entity\User;
use App\Repository\MessageRepository;
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
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param User $user
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addUser(User $user){
        $user->setRoles([User::ROLE_STANDARD]);
        // TODO: UJ Database is unable to accept big passwords.
        $user->setPassword(
            $this->userRepository->passwordEncoder->encodePassword(
               $user,
               $user->getPassword()
            )
        );
        $this->userRepository->save($user);
    }
}
