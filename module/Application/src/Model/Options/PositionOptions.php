<?php

namespace Application\Model\Options;

use Application\Model\Repository\PositionRepositoryInterface;

class PositionOptions
{
    /**
     * @var PositionRepositoryInterface
     */
    private $repository;

    /**
     * @param PositionRepositoryInterface $repository
     */
    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return string[]
     */
    public function getOptions()
    {
        $positions = [];

        foreach ($this->repository->findAllPositions() as $position) {
            $positions[$position->getId()] = $position->getName();
        }

        return $positions;
    }

    /**
     * @return string[]
     */
    public function getEnabledOptions()
    {
        $positions = [null => 'Не выбрана'];

        foreach ($this->repository->findAllPositions() as $position) {
            $positions[$position->getId()] = $position->getName();
        }

        return $positions;
    }

    /**
     * @return array
     */
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