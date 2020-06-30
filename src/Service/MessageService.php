<?php
/**
 * Category service.
 */

namespace App\Service;

use App\Entity\Message;
use App\Repository\MessageRepository;

/**
 * Class CategoryService.
 */
class MessageService
{
    /**
     * Category repository.
     *
     * @var \App\Repository\MessageRepository
     */
    private $messageRepository;

    /**
     * CategoryService constructor.
     *
     * @param \App\Repository\MessageRepository $messageRepository Message repository
     */
    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function banMessage(int $messageId)
    {
        $message = $this->messageRepository->findOneBy(['id' => $messageId]);
        $message->setContent('---');
        $this->messageRepository->save($message);
    }

    public function saveMessage(string $activeUser, Message $message)
    {
        $message->setUsername($activeUser);
        $message->setDate(new \DateTime());
        $this->messageRepository->save($message);
    }

    public function getLastMessages(string $activeUser)
    {
        $lastMessages = $this->messageRepository->findBy([], ['date' => 'DESC'], Message::LAST_MESSAGES_COUNT);
        $parsedMessages = [];
        for ($i = Message::LAST_MESSAGES_COUNT - 1; $i >= 0; --$i) {
            array_push(
                $parsedMessages,
                [
                    'username' => $lastMessages[$i]->getUsername(),
                    'dateTime' => $lastMessages[$i]->getDate()->format('d/m/Y'),
                    'content' => $lastMessages[$i]->getContent(),
                    'currentUser' => $activeUser === $lastMessages[$i]->getUsername(),
                    'id' => $lastMessages[$i]->getId(),
                ]);
        }

        return $parsedMessages;
    }
}
