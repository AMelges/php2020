<?php
/**
 * Main controller.
 */

namespace App\Controller;

use App\Entity\User;
use App\Form\UsersType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MainController.
 *
 * @Route("/register")
 */
class RegisterController extends AbstractController
{
    /**
     * Register index.
     *
     * @param Request                             $request             HTTP request
     * @param \App\Repository\UserDataRepository $usersdataRepository UserData repository
     *
     * @return Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     *
     * @Route(
     *     "/",
     *     methods={"GET", "POST"},
     *     name="register_form",
     * )
     */
    public function index(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $user->setRoles([User::ROLE_STANDARD]);
            // TODO: UJ Database is unable to accept bigger passwords.
            $user->setPassword("123"
                //$userRepository->passwordEncoder->encodePassword(
                //   $user,
                //   $user->getPassword()
                //)
            );
            $userRepository->save($user);

            return $this->redirectToRoute('app_login');
        }

        return $this->render(
            'register/index.html.twig',
            ['form' => $form->createView()]
        );
    }
}
