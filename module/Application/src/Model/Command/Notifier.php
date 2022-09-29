<?php

namespace Application\Model\Command;

use Application\Model\Entity\Email;
use Application\Model\Repository\Extracter;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Predicate\Expression;
use Laminas\Db\Sql\Select;
use Laminas\Mail\Message;
use Laminas\Mail\Transport\Sendmail;

class Notifier implements NotifierInterface
{
    private AdapterInterface $db;
    private Email $prototype;

    public function __construct(AdapterInterface $db)
    {
        $this->db = $db;
        $this->prototype = new Email();
    }

    public function sendEmails(array $messages)
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

        /** @var Email[] $mailsInfo */
        $mailsInfo = Extracter::extractValues(
            $select,
            $this->db,
            $this->prototype->getHydrator(),
            $this->prototype
        );

        $transport = new Sendmail();

        foreach ($mailsInfo as $email) {
            $mail = new Message();
            $mail->setBody(
                'You have an unread message from a user with an ID '
                . $email->getUserId()
            );
            $mail->setFrom('infoportal@corp.com', "Employee Information Portal");
            $mail->addTo($email->getAddress(), 'Your name');
            $mail->setSubject('Unread message');

            $transport->send($mail);
        }
    }
}