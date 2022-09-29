<?php

namespace Application\Command;

use Application\Model\Command\NotifierInterface;
use Application\Model\Entity\Email;
use Application\Model\Repository\EmailRepositoryInterface;
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
    private EmailRepositoryInterface $emailRepository;
    private NotifierInterface $notifier;

    public function __construct(
        MessageRepositoryInterface $messageRepository,
        EmailRepositoryInterface   $emailRepository,
        AdapterInterface           $db,
        NotifierInterface          $notifier,
        string                     $name = null
    ) {
        parent::__construct($name);

        $this->db = $db;
        $this->prototype = new Email();
        $this->messageRepository = $messageRepository;
        $this->emailRepository = $emailRepository;
        $this->notifier = $notifier;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $unreadMessages = $this->messageRepository->getUnreadMessages();
        $mails = $this->emailRepository->generateMails($unreadMessages);

        $this->notifier->sendEmails($mails);

        return 0;
    }
}