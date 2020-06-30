<?php


namespace App\Controller;


use App\Entity\User;
use App\Form\UsersType;
use App\Service\AdminService;
use App\Service\RegisterService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MainController.
 *
 * @Route("/admin")
 */
class AdminController
{
    private $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

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
     *     "/panel",
     *     methods={"GET", "POST"},
     *     name="admin_panel",
     * )
     */
    public function index(Request $request): Response
    {

        $user = new User();
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->adminService->addUser($user);
            return $this->redirectToRoute('app_login');
        }

        return $this->render(
            'register/index.html.twig',
            ['form' => $form->createView()]
        );
    }
}