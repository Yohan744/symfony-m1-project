<?php

namespace App\DataFixtures;

use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ThemeFixture extends fixture
{

    public function load(ObjectManager $manager): void
    {
        $manager->persist($this->createTheme("plain", "#0E4428", "#ffffff"));
        $manager->persist($this->createTheme("snow", "#212b4f", "#ffffff"));
        $manager->persist($this->createTheme("water", "#0A0919", "#ffffff"));
        $manager->flush();
    }

    public function createTheme(string $url, string $primary, string $secondary): Theme {
        $theme = new Theme();
        $theme->setImage("images/themes/" . $url . ".jpg");
        $theme->setPrimaryColor($primary);
        $theme->setSecondaryColor($secondary);
        return $theme;
    }

}