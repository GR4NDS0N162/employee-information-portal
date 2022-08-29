<?php

namespace Application\Model\Options;

use Application\Model\PositionRepositoryInterface;

class PositionOptions
{
    private const positions = [
        '1' => 'Уборщик',
        '2' => 'Фасовщик',
        '3' => 'Менеджер',
        '4' => 'Швейцар',
        '5' => 'Шеф',
        '6' => 'Экономист',
        '7' => 'Электрик',
        '8' => 'Юрист',
    ];

    /**
     * @var PositionRepositoryInterface
     */
    private $repository;

    public function __construct(PositionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public static function getOptions()
    {
        return self::positions;
    }

    public static function getEnabledOptions()
    {
        return array_merge([
            null => [
                'label'    => 'Не выбрана',
                'selected' => 'selected',
            ],
        ], self::positions);
    }

    public static function getDisabledOptions()
    {
        return array_merge([
            null => [
                'label'    => 'Не выбрана',
                'disabled' => 'disabled',
                'selected' => 'selected',
            ],
        ], self::positions);
    }
}