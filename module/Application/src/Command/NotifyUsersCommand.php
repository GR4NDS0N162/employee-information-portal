<?php

namespace Application\Command;

use Application\Model\Command\NotifierInterface;
use Application\Model\Entity\Email;
use Application\Model\Entity\Message;
use Application\Model\Repository\Extracter;
use Application\Model\Repository\MessageRepositoryInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Predicate\Expression;
use Laminas\Db\Sql\Select;
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
        MessageRepositoryInterface $messageRepository,
        AdapterInterface           $db,
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
        $mails = $this->generateMails($unreadMessages);

        $this->notifier->sendEmails($mails);

        return 0;
    }

    /**
     * @param Message[] $messages
     *
     * @return Email[]
     */
    private function generateMails(array $messages): array
    {
        $select = new Select(['mes' => 'message']);
        $select->columns([
            'address' => new Expression('MIN(e.address)'),
            'userId'  => 'mes.user_id',
        ], false);
        $select->join(
            ['mem' => 'member'],
            new Expression(
                'mes.dialog_id = mem.dialog_id ' .
                'AND mes.user_id != mem.user_id'
            ),
            []
        );
        $select->join(
            ['e' => 'email'],
            'mem.user_id = e.user_id',
            []
        );
        $select->where([
            'mes.id' => array_column($messages, 'id'),
        ]);
        $select->group(['e.user_id', 'mes.user_id']);

        return Extracter::extractValues(
            $select,
            $this->db,
            $this->prototype->getHydrator(),
            $this->prototype
        );
    }
}