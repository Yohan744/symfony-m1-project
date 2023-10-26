<?php

namespace App\Controller;

use App\Entity\Building;
use App\Entity\Theme;
use App\FormType\ThemeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;

class GameController extends AbstractController
{
    #[Route('/game', name: 'app_game')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        $environement = $session->get('environment');
        $pseudo = $session->get('pseudo');

        $theme = $this->getTheme($environement);

        $building = new Building();
        $building->setName("Hotel de ville");
        $building->setDescription("Ceci est le batiment principale de votre village. ");
        $buildings = [$building, $building, $building];

        return $this->render('game/index.html.twig', [
            'theme' => $theme,
            "pseudo" => $pseudo,
            "buildings" => $buildings
        ]);
    }

    public function getTheme(string $environement): Theme
    {
        $theme = new Theme();
        $theme->setImage("images/theme/" . $environement . ".jpg");

        $theme->setPrimaryColor($environement);

        return $theme;
    }
}
