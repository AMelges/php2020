<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\AdminService;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController.
 *
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    private $adminService;

    /**
     * AdminController constructor.
     * @param AdminService $adminService
     */
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * Admin panel index.
     *
     * @param Request        $request        HTTP request
     * @param UserRepository $userRepository User repository
     *
     * @return Response HTTP response
     *
     * @Route(
     *     "/panel",
     *     methods={"GET", "POST"},
     *     name="admin_panel",
     * )
     */
    public function index(Request $request, UserRepository $userRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $userRepository->queryAll(),
            $request->query->getInt('page', 1),
            UserRepository::USERS_PER_PAGE_COUNT
        );

        return $this->render(
            'admin/index.html.twig',
            ['pagination' => $pagination]
        );
    }

    /**
     * Admin panel ban action.
     *
     * @param Request $request HTTP request
     *
     * @return Response HTTP response
     *
     * @throws ORMException
     * @throws OptimisticLockException
     *
     * @Route(
     *     "/ban",
     *     methods={"POST"},
     *     name="admin_panel_banUser",
     * )
     */
    public function banUser(Request $request): Response
    {
        $userId = $request->get('userId');
        if ($userId) {
            $this->adminService->banUser($userId);
        }

        return $this->redirectToRoute('admin_panel');
    }

    /**
     * Admin panel unban action.
     *
     * @param Request $request HTTP request
     *
     * @return Response HTTP response
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Exception
     *
     * @Route(
     *     "/unban",
     *     methods={"POST"},
     *     name="admin_panel_unbanUser",
     * )
     */
    public function unbanUser(Request $request): Response
    {
        $userId = $request->get('userId');
        if ($userId) {
            $this->adminService->unbanUser($userId);
        }

        return $this->redirectToRoute('admin_panel');
    }

    /**
     * Admin panel grant admin role action.
     *
     * @param Request $request HTTP request
     *
     * @return Response HTTP response
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Exception
     *
     * @Route(
     *     "/grantAdmin",
     *     methods={"POST"},
     *     name="admin_panel_grantAdmin",
     * )
     */
    public function grantAdmin(Request $request): Response
    {
        $userId = $request->get('userId');
        if ($userId) {
            $this->adminService->addAdminRole($userId);
        }

        return $this->redirectToRoute('admin_panel');
    }

    /**
     * Admin panel revoke admin role action.
     *
     * @param Request $request HTTP request
     *
     * @return Response HTTP response
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Exception
     *
     * @Route(
     *     "/revokeAdmin",
     *     methods={"POST"},
     *     name="admin_panel_revokeAdmin",
     * )
     */
    public function revokeAdmin(Request $request): Response
    {
        $userId = $request->get('userId');
        if ($userId) {
            $this->adminService->removeAdminRole($userId);
        }

        return $this->redirectToRoute('admin_panel');
    }
}
