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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

/**
 * Class MainController.
 *
 * @Route("/message")
 */
class MessageController extends AbstractController
{
    private $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * Index action.
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @Route(
     *     "/",
     *     methods={"GET", "POST"},
     *     name="message_index",
     *     defaults={},
     *     requirements={},
     * )
     */
    public function index(Request $request, UserRepository $userRepository, MessageRepository $messageRepository): Response
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
            ]
        );
    }
}
