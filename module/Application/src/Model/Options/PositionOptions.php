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

    public function getOptions(): array
    {
        $positions = [];

        foreach ($this->repository->findAllPositions() as $position) {
            $positions[$position->getId()] = $position->getName();
        }

        return $positions;
    }

    public function getEnabledOptions(): array
    {
        $positions = [
            null => [
                'label'    => 'Не выбрана',
                'selected' => 'selected',
            ],
        ];

        foreach ($this->repository->findAllPositions() as $position) {
            $positions[$position->getId()] = $position->getName();
        }

        return $positions;
    }

    public function getDisabledOptions(): array
    {
        $positions = [
            null => [
                'label'    => 'Не выбрана',
                'disabled' => 'disabled',
                'selected' => 'selected',
            ],
        ];

        foreach ($this->repository->findAllPositions() as $position) {
            $positions[$position->getId()] = $position->getName();
        }

        return $positions;
    }
}