<?php

namespace App\Components;

use App\Entity\Building;
use App\Entity\Theme;
use App\Repository\BuildingStateRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('buildingCard')]
class BuildingCardComponent
{
    public Building $building;

    public function __construct(
        private BuildingStateRepository $buildingStateRepository
    ) {
    }

    public function getCurrentState()
    {
        return $this->building->getCurrentBuildingState($this->buildingStateRepository);
    }
}
