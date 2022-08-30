<?php

namespace Application\Model\Options;

class PositionOptions
{
    private $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function getOptions()
    {
        $positions = [];

        foreach ($this->repository->findAllPositions() as $position) {
            $positions[$position->getId()] = $position->getName();
        }

        return $positions;
    }

    public function getEnabledOptions()
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

    public function getDisabledOptions()
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