<?php

namespace Application\Helper;

use Laminas\Db\Sql\Predicate\Expression;
use Laminas\Db\Sql\Predicate\Like;
use Laminas\Db\Sql\Predicate\PredicateSet;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;

class ConfigHelper
{
    public static function parseWhereConfig(
        array  $whereConfig,
        ?Where $where = null
    ): Where {
        if (!isset($where)) {
            $where = new Where();
        }

        if (isset($whereConfig['positionId'])) {
            $positionId = (integer)$whereConfig['positionId'];
            $where->equalTo('u.position_id', $positionId);
        }

        if (isset($whereConfig['gender'])) {
            $gender = (integer)$whereConfig['gender'];
            $where->equalTo('u.gender', $gender);
        }

        if (isset($whereConfig['age'])) {
            $ageConfig = $whereConfig['age'];

            if (isset($ageConfig['min'])) {
                $minAge = (integer)$ageConfig['min'];

                $where->greaterThanOrEqualTo(
                    new Expression('TIMESTAMPDIFF(YEAR, u.birthday, NOW())'),
                    $minAge,
                );
            }

            if (isset($ageConfig['max'])) {
                $maxAge = (integer)$ageConfig['max'];

                $where->lessThanOrEqualTo(
                    new Expression('TIMESTAMPDIFF(YEAR, u.birthday, NOW())'),
                    $maxAge,
                );
            }
        }

        if (
            isset($whereConfig['fullnamePhone'])
            || isset($whereConfig['fullnamePhoneEmail'])
        ) {
            list($fullnameConfig, $phoneConfig, $emailConfig) = array_map(
                'trim',
                explode(',', $whereConfig['fullnamePhoneEmail'] ?: $whereConfig['fullnamePhone'])
            );

            $fullnameConfig = ConfigHelper::filterEmpty(explode(' ', $fullnameConfig));
            if (!empty($fullnameConfig)) {
                $fullnameWhere = new Where(null, PredicateSet::COMBINED_BY_OR);

                foreach ($fullnameConfig as $str) {
                    $str = strtolower($str);
                    $fullnameWhere->like(new Expression('LOWER(u.surname)'), '%' . $str . '%');
                    $fullnameWhere->like(new Expression('LOWER(u.name)'), '%' . $str . '%');
                    $fullnameWhere->like(new Expression('LOWER(u.patronymic)'), '%' . $str . '%');
                }

                $where->addPredicates($fullnameWhere);
                unset($fullnameWhere);
            }

            if (
                isset($phoneConfig)
                && $phoneConfig != ''
            ) {
                $phoneSelect = new Select('phone');
                $phoneSelect->columns([
                    'user_id',
                ], false);
                $phoneSelect->where(new Like('number', '%' . $phoneConfig . '%'));

                $where->in('u.id', $phoneSelect);
                unset($phoneSelect);
            }

            if (
                isset($whereConfig['fullnamePhoneEmail'])
                && isset($emailConfig)
                && $emailConfig != ''
            ) {
                $emailSelect = new Select('email');
                $emailSelect->columns([
                    'user_id',
                ], false);
                $emailSelect->where(new Like('address', '%' . $emailConfig . '%'));

                $where->in('u.id', $emailSelect);
                unset($emailSelect);
            }
        }

        if (isset($whereConfig['active'])) {
            $activeSelect = new Select(['us' => 'user_status']);
            $activeSelect->columns([
                'us.user_id',
            ], false);
            $activeSelect->join(
                ['s' => 'status'],
                's.id = us.status_id',
                [],
            );
            $activeSelect->where(['s.name' => 'active']);

            $statusConfig = $whereConfig['active'];

            if ($statusConfig == '1') {
                $where->in('u.id', $activeSelect);
            } elseif ($statusConfig == '2') {
                $where->notIn('u.id', $activeSelect);
            }
        }

        if (isset($whereConfig['admin'])) {
            $adminSelect = new Select(['us' => 'user_status']);
            $adminSelect->columns([
                'us.user_id',
            ], false);
            $adminSelect->join(
                ['s' => 'status'],
                's.id = us.status_id',
                [],
            );
            $adminSelect->where(['s.name' => 'admin']);

            $statusConfig = $whereConfig['admin'];

            if ($statusConfig == '1') {
                $where->in('u.id', $adminSelect);
            } elseif ($statusConfig == '2') {
                $where->notIn('u.id', $adminSelect);
            }
        }

        return $where;
    }

    public static function filterEmpty(array $array): array
    {
        foreach ($array as $key => & $value) {
            if (is_array($value)) {
                $value = ConfigHelper::filterEmpty($value);
            }
            if (!$value) {
                unset($array[$key]);
            }
        }
        unset($value);

        return $array;
    }

    public static function parseOrderConfig(string $orderConfig): array
    {
        $order = [
            'u.surname',
            'u.name',
            'u.patronymic',
            'pos.name',
            'u.gender',
            'u.birthday DESC',
        ];

        switch ($orderConfig) {
            case 'fullname':
                return $order;

            case 'position':
                array_unshift($order, 'pos.name');
                break;
            case 'age':
                array_unshift($order, 'u.birthday DESC');
                break;
            case 'gender':
                array_unshift($order, 'u.gender');
                break;

            default:
                return [];
        }

        return array_unique($order);
    }
}