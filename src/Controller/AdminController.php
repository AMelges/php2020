<?php


namespace App\Controller;


use App\Entity\User;
use App\Form\UsersType;
use App\Repository\UserRepository;
use App\Service\AdminService;
use App\Service\RegisterService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\MessagesType;
use App\Repository\MessageRepository;
use App\Service\MessageService;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

/**
 * Class MainController.
 *
 * @Route("/admin")
 */
class AdminController extends AbstractController
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
    public function index(Request $request, UserRepository $taskRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $taskRepository->queryAll(),
            $request->query->getInt('page', 1),
            UserRepository::USERS_PER_PAGE_COUNT
        );

        return $this->render(
            'admin/index.html.twig',
            ['pagination' => $pagination]
        );
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
     *     "/ban",
     *     methods={"POST"},
     *     name="admin_panel_banUser",
     * )
     */
    public function banUser(Request $request, UserRepository $taskRepository, PaginatorInterface $paginator): Response
    {
        $userId = $request->get('userId');
        if ($userId)
        {
            $this->adminService->banUser($userId);
        }

        return $this->redirectToRoute('admin_panel');
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
     *     "/unban",
     *     methods={"POST"},
     *     name="admin_panel_unbanUser",
     * )
     */
    public function unbanUser(Request $request, UserRepository $taskRepository, PaginatorInterface $paginator): Response
    {
        $userId = $request->get('userId');
        if ($userId)
        {
            $this->adminService->unbanUser($userId);
        }

        return $this->redirectToRoute('admin_panel');
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
     *     "/grantAdmin",
     *     methods={"POST"},
     *     name="admin_panel_grantAdmin",
     * )
     */
    public function grantAdmin(Request $request, UserRepository $taskRepository, PaginatorInterface $paginator): Response
    {
        $userId = $request->get('userId');
        if ($userId)
        {
            $this->adminService->addAdminRole($userId);
        }

        return $this->redirectToRoute('admin_panel');
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
     *     "/revokeAdmin",
     *     methods={"POST"},
     *     name="admin_panel_revokeAdmin",
     * )
     */
    public function revokeAdmin(Request $request, UserRepository $taskRepository, PaginatorInterface $paginator): Response
    {
        $userId = $request->get('userId');
        if ($userId)
        {
            $this->adminService->removeAdminRole($userId);
        }

        return $this->redirectToRoute('admin_panel');
    }
}