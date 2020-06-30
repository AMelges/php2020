<?php
/**
 * Category service.
 */

namespace App\Service;

use App\Entity\Message;
use App\Repository\MessageRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

/**
 * Class CategoryService.
 */
class MessageService
{
    /**
     * Category repository.
     *
     * @var MessageRepository
     */
    private $messageRepository;

    /**
     * CategoryService constructor.
     *
     * @param MessageRepository $messageRepository Message repository
     */
    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * @param int $messageId
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function banMessage(int $messageId)
    {
        $message = $this->messageRepository->findOneBy(['id' => $messageId]);
        $message->setContent('---');
        $this->messageRepository->save($message);
    }

    /**
     * @param string $activeUser
     * @param Message $message
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function saveMessage(string $activeUser, Message $message)
    {
        $message->setUsername($activeUser);
        $message->setDate(new \DateTime());
        $this->messageRepository->save($message);
    }

    /**
     * @param string $activeUser
     * @return array
     */
    public function getLastMessages(string $activeUser)
    {
        $lastMessages = $this->messageRepository->findBy([], ['date' => 'DESC'], Message::LAST_MESSAGES_COUNT);

        $parsedMessages = [];
        for ($i = count($lastMessages)-1; $i >= 0; --$i) {
            array_push(
                $parsedMessages,
                [
                    'username' => $lastMessages[$i]->getUsername(),
                    'dateTime' => $lastMessages[$i]->getDate()->format('d/m/Y'),
                    'content' => $lastMessages[$i]->getContent(),
                    'currentUser' => $activeUser === $lastMessages[$i]->getUsername(),
                    'id' => $lastMessages[$i]->getId(),
                ]
            );
        }

        return $parsedMessages;
    }
}
