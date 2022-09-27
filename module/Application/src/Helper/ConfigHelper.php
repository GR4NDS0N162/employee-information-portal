<?php

namespace Application\Helper;

use Laminas\Db\Sql\Predicate\Expression;
use Laminas\Db\Sql\Predicate\Like;
use Laminas\Db\Sql\Predicate\PredicateSet;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;

class ConfigHelper
{
    /** @var string An option indicating that the status belongs to the user. */
    const YES_OPTION = '1';
    /** @var string An option indicating that the status doesn't belong to the user. */
    const NO_OPTION = '2';

    public static function parseWhereConfig(
        array  $whereConfig,
        ?Where $where = null
    ): Where {
        if (!isset($where)) {
            $where = new Where();
        }

        self::addPositionFilter($whereConfig, $where);

        self::addGenderFilter($whereConfig, $where);

        self::addAgeFilter($whereConfig, $where);

        if (
            isset($whereConfig['fullnamePhone'])
            || isset($whereConfig['fullnamePhoneEmail'])
        ) {
            list($fullnameConfig, $phoneConfig, $emailConfig) = array_map(
                'trim',
                explode(',', $whereConfig['fullnamePhoneEmail'] ?: $whereConfig['fullnamePhone'])
            );

            self::addFullnameFilter($fullnameConfig, $where);

            self::addLikeFilter('phone', 'number', $phoneConfig, $where);

            if (isset($whereConfig['fullnamePhoneEmail'])) {
                self::addLikeFilter('email', 'address', $emailConfig, $where);
            }
        }

        self::addStatusFilter('active', $whereConfig, $where);
        self::addStatusFilter('admin', $whereConfig, $where);

        return $where;
    }

    private static function addLikeFilter(
        string  $table,
        string  $searchColumn,
        ?string $configString,
        Where   $where
    ) {
        if (
            isset($configString)
            && $configString != ''
        ) {
            $valueSet = new Select($table);
            $valueSet->columns(['user_id'], false);
            $valueSet->where(new Like($searchColumn, '%' . $configString . '%'));

            $where->in('u.id', $valueSet);
        }
    }

    private static function addEmailFilter(
        ?string $configString,
        Where   $where
    ) {
        if (
            isset($configString)
            && $configString != ''
        ) {
            $emailSelect = new Select('email');
            $emailSelect->columns([
                'user_id',
            ], false);
            $emailSelect->where(new Like('address', '%' . $configString . '%'));

            $where->in('u.id', $emailSelect);
        }
    }

    private static function addPhoneFilter(
        ?string $configString,
        Where   $where
    ) {
        if (
            isset($configString)
            && $configString != ''
        ) {
            $phoneSelect = new Select('phone');
            $phoneSelect->columns([
                'user_id',
            ], false);
            $phoneSelect->where(new Like('number', '%' . $configString . '%'));

            $where->in('u.id', $phoneSelect);
            unset($phoneSelect);
        }
    }

    private static function addFullnameFilter(
        ?string $configString,
        Where   $where
    ) {
        $config = self::filterEmpty(explode(' ', $configString));

        if (!empty($config)) {
            $fullnameWhere = new Where(null, PredicateSet::COMBINED_BY_OR);

            foreach ($config as $str) {
                $str = strtolower($str);
                $fullnameWhere->like(new Expression('LOWER(u.surname)'), '%' . $str . '%');
                $fullnameWhere->like(new Expression('LOWER(u.name)'), '%' . $str . '%');
                $fullnameWhere->like(new Expression('LOWER(u.patronymic)'), '%' . $str . '%');
            }

            $where->addPredicates($fullnameWhere);
        }
    }

    private static function addPositionFilter(
        array $whereConfig,
        Where $where
    ) {
        if (isset($whereConfig['positionId'])) {
            $positionId = (integer)$whereConfig['positionId'];
            $where->equalTo('u.position_id', $positionId);
        }
    }

    private static function addGenderFilter(
        array $whereConfig,
        Where $where
    ) {
        if (isset($whereConfig['gender'])) {
            $gender = (integer)$whereConfig['gender'];
            $where->equalTo('u.gender', $gender);
        }
    }

    private static function addAgeFilter(
        array $whereConfig,
        Where $where
    ) {
        if (isset($whereConfig['age'])) {
            $ageConfig = $whereConfig['age'];

            self::addBetweenFilter(
                new Expression('TIMESTAMPDIFF(YEAR, u.birthday, NOW())'),
                $ageConfig,
                $where
            );
        }
    }

    private static function addBetweenFilter(
        Expression $operand,
        array      $config,
        Where      $where
    ) {
        if (isset($config['min']) && isset($config['max'])) {
            $min = (integer)$config['min'];
            $max = (integer)$config['max'];
            $where->between($operand, $min, $max);
        } elseif (isset($config['min'])) {
            $min = (integer)$config['min'];
            $where->greaterThanOrEqualTo($operand, $min);
        } elseif (isset($config['max'])) {
            $max = (integer)$config['max'];
            $where->lessThanOrEqualTo($operand, $max);
        }
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

    private static function addStatusFilter(
        string $statusName,
        array  $whereConfig,
        Where  $where
    ) {
        if (isset($whereConfig[$statusName])) {
            $valueSet = new Select(['us' => 'user_status']);
            $valueSet->columns([
                'us.user_id',
            ], false);
            $valueSet->join(
                ['s' => 'status'],
                's.id = us.status_id',
                [],
            );
            $valueSet->where(['s.name' => $statusName]);

            $statusConfig = $whereConfig[$statusName];

            if ($statusConfig == self::YES_OPTION) {
                $where->in('u.id', $valueSet);
            } elseif ($statusConfig == self::NO_OPTION) {
                $where->notIn('u.id', $valueSet);
            }
        }
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