<?php
/**
 * Main controller.
 */

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessagesType;
use App\Repository\MessageRepository;
use App\Repository\UserRepository;
use App\Service\MessageService;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

/**
 * Class MessageController.
 *
 * @Route("/message")
 */
class MessageController extends AbstractController
{
    /**
     * MessageService
     *
     * @var MessageService
     */
    private $messageService;

    /**
     * MessageController constructor.
     * @param MessageService $messageService
     */
    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * Messages index action, renders panel to see and send messages.
     *
     * @param Request $request
     * @param UserRepository $userRepository
     * @return Response HTTP response
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @Route(
     *     "/",
     *     methods={"GET", "POST"},
     *     name="message_index",
     * )
     */
    public function index(Request $request, UserRepository $userRepository): Response
    {
        $messageId = $request->get('messageId');
        if ($messageId) {
            $this->messageService->banMessage($messageId);
        }

        $user = $userRepository->findOneBy(['email' => $this->getUser()->getUsername()]);

        if (!$user) {
            throw new CustomUserMessageAuthenticationException('Email could not be found.');
        }

        $activeUser = $user->getId().'_'.$user->getUsername();
        $message = new Message();
        $form = $this->createForm(MessagesType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->messageService->saveMessage($activeUser, $message);

            return $this->redirectToRoute('message_index');
        }

        return $this->render(
            'message/index.html.twig',
            [
                'form' => $form->createView(),
                'parsedMessages' => $this->messageService->getLastMessages($activeUser),
                'adminPrivileges' => $this->isGranted('ROLE_ADMIN'),
                'isBanned' => $user->getIsbanned(),
            ]
        );
    }
}
