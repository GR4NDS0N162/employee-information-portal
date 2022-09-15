<?php

namespace Application\Controller;

use Application\Form\Admin as Form;
use Application\Model\Command\PositionCommandInterface;
use Application\Model\Command\UserCommandInterface;
use Application\Model\Entity\PositionList;
use Application\Model\Repository\PositionRepositoryInterface;
use Application\Model\Repository\UserRepositoryInterface;
use InvalidArgumentException;
use Laminas\Db\Sql\Predicate\Expression;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class AdminController extends AbstractActionController
{
    public const maxPageCount = 5;
    public const userId = 1;

    /**
     * @var Form\PositionForm
     */
    private $positionForm;
    /**
     * @var Form\UserForm
     */
    private $userForm;
    /**
     * @var Form\AdminFilterForm
     */
    private $adminFilterForm;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var PositionRepositoryInterface
     */
    private $positionRepository;
    /**
     * @var UserCommandInterface
     */
    private $userCommand;
    /**
     * @var PositionCommandInterface
     */
    private $positionCommand;

    /**
     * @param Form\PositionForm           $positionForm
     * @param Form\UserForm               $userForm
     * @param Form\AdminFilterForm        $adminFilterForm
     * @param UserRepositoryInterface     $userRepository
     * @param PositionRepositoryInterface $positionRepository
     * @param UserCommandInterface        $userCommand
     * @param PositionCommandInterface    $positionCommand
     */
    public function __construct(
        $positionForm,
        $userForm,
        $adminFilterForm,
        $userRepository,
        $positionRepository,
        $userCommand,
        $positionCommand
    ) {
        $this->positionForm = $positionForm;
        $this->userForm = $userForm;
        $this->adminFilterForm = $adminFilterForm;
        $this->userRepository = $userRepository;
        $this->positionRepository = $positionRepository;
        $this->userCommand = $userCommand;
        $this->positionCommand = $positionCommand;
    }

    public function viewUserListAction()
    {
        $viewModel = new ViewModel();

        $this->layout()->setVariable('headTitleName', 'Список пользователей (Администратор)');
        $this->layout()->setVariable('navbar', 'Laminas\Navigation\Admin');

        $viewModel->setVariables([
            'userInfo'           => $this->userRepository->findUsers(),
            'positionRepository' => $this->positionRepository,
            'page'               => 1,
            'adminFilterForm'    => $this->adminFilterForm,
        ]);

        return $viewModel;
    }

    public function getUsersAction()
    {
        $request = $this->getRequest();

        if (!$request->isXmlHttpRequest() || !$request->isPost()) {
            exit();
        }

        $data = $request->getPost()->toArray();
        parse_str($data['where'], $data['where']);
        $data['where'] = array_filter_recursive($data['where']);

        list($page, $order, $where) = extractOptions($data);

        if (isset($data['updatePage'])) {
            $count = count($this->userRepository->findUsers($where));
            echo json_encode([
                'count'        => $count,
                'maxPageCount' => self::maxPageCount,
            ]);
            exit();
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setTemplate('partial/user-list-admin.phtml');

        $viewModel->setVariables([
            'userList' => $this->userRepository->findUsers(
                $where,
                $order,
                true,
                $page
            ),
        ]);

        return $viewModel;
    }

    public function editUserAction()
    {
        $userId = (int)$this->params()->fromRoute('id');

        if (empty($userId)) {
            return $this->redirect()->toRoute('admin/view-user-list');
        }

        try {
            $user = $this->userRepository->findUser($userId);
        } catch (InvalidArgumentException $ex) {
            return $this->redirect()->toRoute('admin/view-user-list');
        }

        $this->layout()->setVariables([
            'headTitleName' => 'Редактирование пользователя (Администратор)',
            'navbar'        => 'Laminas\Navigation\Admin',
        ]);

        $this->userForm->bind($user);
        $viewModel = new ViewModel(['userForm' => $this->userForm]);

        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $viewModel;
        }

        $this->userForm->setData($request->getPost());

        if (!$this->userForm->isValid()) {
            return $viewModel;
        }

        $this->userCommand->updateUser($user);
        return $this->redirect()->toRoute('admin/view-user-list');
    }

    public function editPositionsAction()
    {
        $this->layout()->setVariables([
            'headTitleName' => 'Управление должностями (Администратор)',
            'navbar'        => 'Laminas\Navigation\Admin'
        ]);

        $list = $this->positionRepository->findAllPositions();
        $positionList = new PositionList($list);
        $this->positionForm->bind($positionList);

        $viewModel = new ViewModel(['positionForm' => $this->positionForm]);

        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $viewModel;
        }

        $this->positionForm->setData($request->getPost());

        if (!$this->positionForm->isValid()) {
            return $viewModel;
        }

        $this->positionCommand->updatePositions(
            $this->positionForm->getObject()
        );

        return $this->redirect()->toRoute('admin/edit-position');
    }
}

function extractOptions(array $data): array
{
    $page = (int)$data['page'];

    $order = [
        'u.surname',
        'u.name',
        'u.patronymic',
        'pos.name',
        'u.gender',
        'u.birthday DESC',
    ];
    if ($data['order'] == 'position') {
        array_unshift($order, 'pos.name');
    } elseif ($data['order'] == 'age') {
        array_unshift($order, 'u.birthday DESC');
    } elseif ($data['order'] == 'gender') {
        array_unshift($order, 'u.gender');
    }
    $order = array_unique($order);

    $whereArr = $data['where'];
    $where = [];
    if (isset($whereArr['positionId'])) {
        $where[] = new Expression(
            'u.position_id = ?',
            [$whereArr['positionId']]
        );
    }
    if (isset($whereArr['gender'])) {
        $where[] = new Expression(
            'u.gender = ?',
            [$whereArr['gender']]
        );
    }
    if (isset($whereArr['active'])) {
        $sign = $whereArr['active'] == '1' ? 'IN' : 'NOT IN';
        $where[] = new Expression('u.id ' . $sign . ' ( SELECT us.user_id FROM user_status us WHERE us.status_id = 2 )');
    }
    if (isset($whereArr['admin'])) {
        $sign = $whereArr['admin'] == '1' ? 'IN' : 'NOT IN';
        $where[] = new Expression('u.id ' . $sign . ' ( SELECT us.user_id FROM user_status us WHERE us.status_id = 1 )');
    }
    if (isset($whereArr['age'])) {
        if (isset($whereArr['age']['min'])) {
            $where[] = new Expression('TIMESTAMPDIFF(YEAR, u.birthday, NOW()) > ?', [$whereArr['age']['min']]);
        }
        if (isset($whereArr['age']['max'])) {
            $where[] = new Expression('TIMESTAMPDIFF(YEAR, u.birthday, NOW()) < ?', [$whereArr['age']['max']]);
        }
    }
    $empty = '-';
    if (isset($whereArr['fullnamePhone'])) {
        $filterArr = array_map('trim', explode(',', $whereArr['fullnamePhoneEmail']));
        if (count($filterArr) == 2) {
            list($fullname, $phone) = $filterArr;
            $where = getWhere($fullname, $empty, $where, $phone);
        }
    } elseif (isset($whereArr['fullnamePhoneEmail'])) {
        $filterArr = array_map('trim', explode(',', $whereArr['fullnamePhoneEmail']));
        if (count($filterArr) == 3) {
            list($fullname, $phone, $email) = $filterArr;
            $where = getWhere($fullname, $empty, $where, $phone);

            if ($email != $empty) {
                $where[] = new Expression(
                    'u.id IN ( SELECT e.user_id FROM email AS e ' .
                    'WHERE e.address LIKE LOWER(CONCAT("%", ?, "%")))', [$email]
                );
            }
        }
    }
    return array($page, $order, $where);
}

/**
 * @param        $fullname
 * @param string $empty
 * @param array  $where
 * @param        $phone
 *
 * @return array
 */
function getWhere($fullname, string $empty, array $where, $phone): array
{
    $fullnameArr = explode(' ', $fullname);

    if (count($fullnameArr) == 3) {
        list($surname, $name, $patronymic) = $fullnameArr;
        if ($surname != $empty) {
            $where[] = new Expression('LOWER(u.surname) LIKE LOWER(CONCAT("%", ?, "%"))', [$surname]);
        }
        if ($name != $empty) {
            $where[] = new Expression('LOWER(u.name) LIKE LOWER(CONCAT("%", ?, "%"))', [$name]);
        }
        if ($patronymic != $empty) {
            $where[] = new Expression('LOWER(u.patronymic) LIKE LOWER(CONCAT("%", ?, "%"))', [$patronymic]);
        }
    }

    if ($phone != $empty) {
        $where[] = new Expression(
            'u.id IN ( SELECT ph.user_id FROM phone AS ph ' .
            'WHERE ph.number LIKE LOWER(CONCAT("%", ?, "%")))', [$phone]
        );
    }
    return $where;
}

function array_filter_recursive($array, $callback = null)
{
    foreach ($array as $key => & $value) {
        if (is_array($value)) {
            $value = array_filter_recursive($value, $callback);
            if (!$value) {
                unset($array[$key]);
            }
        } else {
            if (!is_null($callback)) {
                if (!$callback($value)) {
                    unset($array[$key]);
                }
            } else {
                if (!$value) {
                    unset($array[$key]);
                }
            }
        }
    }
    unset($value);

    return $array;
}
