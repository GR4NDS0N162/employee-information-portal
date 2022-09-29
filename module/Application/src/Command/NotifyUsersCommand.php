<?php

namespace Application\Command;

use Application\Model\Command\NotifierInterface;
use Application\Model\Entity\Email;
use Application\Model\Entity\Message;
use Application\Model\Repository\MessageRepositoryInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class NotifyUsersCommand extends Command
{
    private AdapterInterface $db;
    private Email $prototype;
    private MessageRepositoryInterface $messageRepository;
    private NotifierInterface $notifier;

    public function __construct(
        AdapterInterface           $db,
        MessageRepositoryInterface $messageRepository,
        NotifierInterface          $notifier,
        string                     $name = null
    ) {
        parent::__construct($name);

        $this->db = $db;
        $this->prototype = new Email();
        $this->messageRepository = $messageRepository;
        $this->notifier = $notifier;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $unreadMessages = $this->messageRepository->getUnreadMessages();
        $this->notifier->sendEmails($unreadMessages);
        return 0;
    }

    /**
     * @param Message[] $messages
     *
     * @return Email[]
     */
    private function generateMails(array $messages): array
    {
        // TODO: Implement generateMails() method.
    }
}