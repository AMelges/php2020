<?php
/**
 * Main controller.
 */

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessagesType;
use App\Repository\MessageRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

/**
 * Class MainController.
 *
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * Role admin.
     *
     * @var string
     */
    const LAST_MESSAGES_COUNT = 5;

    /**
     * Index action.
     *
     * @param string $name User input
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/",
     *     methods={"GET", "POST"},
     *     name="user_index",
     *     defaults={},
     *     requirements={},
     * )
     */
    public function index(Request $request, UserRepository $userRepository, MessageRepository $messageRepository): Response
    {
        $user = $userRepository->findOneBy(['email' => $this->getUser()->getUsername()]);

        if (!$user) {
            throw new CustomUserMessageAuthenticationException('Email could not be found.');
        }

        $message = new Message();
        $form = $this->createForm(MessagesType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setSenderid($user->getId());
            $message->setDate( new \DateTime());
            $messageRepository->save($message);

            return $this->redirectToRoute('user_index');
        }

        // TODO: add displaying 5 last messages.
        return $this->render(
            'user/index.html.twig',
            ['form' => $form->createView()]
        );
    }
}
