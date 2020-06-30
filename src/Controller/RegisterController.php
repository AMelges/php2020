<?php
/**
 * RegisterController.
 */

namespace App\Controller;

use App\Entity\User;
use App\Form\UsersType;
use App\Repository\UserDataRepository;
use App\Repository\UserRepository;
use App\Service\RegisterService;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RegisterController.
 *
 * @Route("/register")
 */
class RegisterController extends AbstractController
{
    /**
     * RegisterService to ask for registering actions.
     *
     * @var RegisterService
     */
    private $registerService;

    /**
     * RegisterController constructor.
     *
     * @param RegisterService $registerService
     */
    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    /**
     * Register index action, displaying form.
     *
     * @param Request  $request HTTP request
     *
     * @return Response HTTP response
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Exception
     *
     * @Route(
     *     "/",
     *     methods={"GET", "POST"},
     *     name="register_form",
     * )
     */
    public function index(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->registerService->addUser($user);

            return $this->redirectToRoute('app_login');
        }

        return $this->render(
            'register/index.html.twig',
            ['form' => $form->createView()]
        );
    }
}
