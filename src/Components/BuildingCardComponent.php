<?php

namespace App\Components;

use App\Entity\Building;
use App\Entity\Theme;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('buildingCard')]
class BuildingCardComponent
{
    public Building $building;
}
