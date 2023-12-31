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
        $this->addReference(self::TOWNHALL_REFRENCE, $this->createTownHall());
        $manager->flush();
    }

    public function createTownHall(): Building
    {

        $townHall = new Building();

        $townHall->setName("Town Hall");
        $townHall->setDescription("The town hall is the heart of your village. Upgrading it unlocks new buildings and upgrades.");

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
