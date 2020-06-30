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
 * Class RegisterService.
 */
class RegisterService
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
     * @param User $user
     * @throws ORMException
     * @throws OptimisticLockException
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
