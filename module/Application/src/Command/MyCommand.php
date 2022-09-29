<?php

namespace Application\Command;

use Application\Model\Repository\MessageRepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MyCommand extends Command
{
    private MessageRepositoryInterface $messageRepository;

    public function __construct(
        MessageRepositoryInterface $messageRepository,
        string                     $name = null
    ) {
        parent::__construct($name);

        $this->messageRepository = $messageRepository;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $unreadMessages = $this->messageRepository->getUnreadMessages();

        return 0;
    }
}