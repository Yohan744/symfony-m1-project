<?php

namespace App\Controller;

use App\Entity\Building;
use App\Entity\Theme;
use App\Entity\User;
use App\FormType\ThemeType;
use App\Repository\BuildingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class GameController extends AbstractController
{
    #[Route('/game', name: 'app_game')]
    public function index(
        Request $request,
        #[CurrentUser()] User $user,
        BuildingRepository $buildingRepository,
    ): Response {

        $buildings = $buildingRepository->findAll();
        $session = $request->getSession();
        $environement = $session->get('environment');

        $theme = $this->getTheme($environement);

        return $this->render('game/index.html.twig', [
            'theme' => $theme,
            "user" => $user,
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
