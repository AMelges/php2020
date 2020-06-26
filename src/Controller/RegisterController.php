<?php
/**
 * Main controller.
 */

namespace App\Controller;

use App\Entity\Users;
use App\Form\UsersType;
use App\Repository\UsersRepository;
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
     * @param \App\Repository\UsersdataRepository $usersdataRepository Usersdata repository
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
    public function index(Request $request, UsersRepository $usersRepository): Response
    {
        $user = new Users();
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            //$user->setRoles();
            $usersRepository->save($user);

            return $this->redirectToRoute('realm_index');
        }

        return $this->render(
            'register/index.html.twig',
            ['form' => $form->createView()]
        );
    }
}
