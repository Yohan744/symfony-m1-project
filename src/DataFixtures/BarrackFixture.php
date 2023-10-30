<?php

namespace App\DataFixtures;

use App\DataFixtures\TownHallFixture as townHallFixture;
use App\Entity\Building;
use App\Entity\BuildingState;
use App\Entity\Condition;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BarrackFixture extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $manager->persist($this->createBarrack());
        $manager->flush();
    }

    public function createBarrack(): Building
    {

        $barrack = new Building();

        $barrack->setName("Caserne");
        $barrack->setDescription("La caserne permet de former des troupes pour attaquer vos ennemis.");

        $levelZero = new BuildingState(); // the level zero is the construction state
        $levelZero->setLevel(0);
        $levelZero->setImage("images/buildings/barrack/barrack-1.webp");
        $levelZero->setUpgradeCost(5);
        $levelZero->setUpgradeReward(25);

        $levelOne = new BuildingState();
        $levelOne->setLevel(1);
        $levelOne->setImage("images/buildings/barrack/barrack-1.webp");
        $levelOne->setUpgradeCost(10);
        $levelOne->setUpgradeReward(50);

        $levelTwo = new BuildingState();
        $levelTwo->setLevel(2);
        $levelTwo->setImage("images/buildings/barrack/barrack-2.webp");
        $levelTwo->setUpgradeCost(20);
        $levelTwo->setUpgradeReward(100);

        $levelThree = new BuildingState();
        $levelThree->setLevel(3);
        $levelThree->setImage("images/buildings/barrack/barrack-3.webp");
        $levelThree->setUpgradeCost(40);
        $levelThree->setUpgradeReward(200);

        $barrack->addBuildingState($levelZero);
        $barrack->addBuildingState($levelOne);
        $barrack->addBuildingState($levelTwo);
        $barrack->addBuildingState($levelThree);

        $conditionToLevelTwo = new Condition();
        $conditionToLevelTwo->setLevelRequired(2);
        $conditionToLevelTwo->setBuilding($this->getReference(townHallFixture::TOWNHALL_REFRENCE));
        $conditionToLevelTwo->setLinkedBuilding($barrack);

        $conditionToLevelThree = new Condition();
        $conditionToLevelThree->setLevelRequired(3);
        $conditionToLevelThree->setBuilding($this->getReference(townHallFixture::TOWNHALL_REFRENCE));
        $conditionToLevelThree->setLinkedBuilding($barrack);

        $barrack->addCondition($conditionToLevelThree);

        return $barrack;
    }

    public function getDependencies()
    {
        return [
            TownHallFixture::class
        ];
    }
}
