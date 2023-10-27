<?php

namespace App\DataFixtures;

use App\Entity\Building;
use App\Entity\BuildingState;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TownHallFixture extends Fixture
{

    public const TOWNHALL_REFRENCE = "townHall";

    public function load(ObjectManager $manager): void
    {
        $manager->persist($this->createTownHall());
        $manager->flush();
        $this->addReference(self::TOWNHALL_REFRENCE, $this->createTownHall());
    }

    public function createTownHall(): Building {

        $townHall = new Building();

        $townHall->setName("Hôtel de ville");
        $townHall->setDescription("L'hôtel de ville est le coeur de votre village. Son amélioration permet de débloquer des bâtiments");

        $levelOne = new BuildingState();
        $levelOne->setLevel(1);
        $levelOne->setImage("images/townHall/townHall-1.png");
        $levelOne->setUpgradeCost(20);
        $levelOne->setUpgradeReward(100);

        $levelTwo = new BuildingState();
        $levelTwo->setLevel(2);
        $levelTwo->setImage("images/townHall/townHall-2.png");
        $levelTwo->setUpgradeCost(40);
        $levelTwo->setUpgradeReward(200);

        $levelThree = new BuildingState();
        $levelThree->setLevel(3);
        $levelThree->setImage("images/townHall/townHall-3.png");
        $levelThree->setUpgradeCost(80);
        $levelThree->setUpgradeReward(300);

        $townHall->addBuildingState($levelOne);
        $townHall->addBuildingState($levelTwo);
        $townHall->addBuildingState($levelThree);

        return $townHall;

    }

}