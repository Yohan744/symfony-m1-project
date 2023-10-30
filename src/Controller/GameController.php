<?php

namespace App\Controller;

use App\Entity\Building;
use App\Entity\Theme;
use App\Entity\User;
use App\FormType\ThemeType;
use App\Repository\BuildingRepository;
use App\Repository\BuildingStateRepository;
use App\Repository\ThemeRepository;
use Doctrine\ORM\EntityManager;
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
        #[CurrentUser()] User $user,
        BuildingRepository $buildingRepository,
        BuildingStateRepository $buildingStateRepository,
        ThemeRepository $themeRepository,

    ): Response {

        $buildings = $buildingRepository->findByAllExecptTownhall();
        $theme = $themeRepository->findOneById($user->getTheme()->getId());

        $user->getTownHall()->getCurrentBuildingState($buildingStateRepository);

        foreach ($buildings as &$building) {
            $building->getCurrentBuildingState($buildingStateRepository);
        }

        return $this->render('game/index.html.twig', [
            'theme' => $theme,
            "user" => $user,
            "buildings" => $buildings
        ]);
    }

    #[Route('/addCoins', name: 'app_game_add_coins', methods: ['GET'])]
    public function addCoins(
        #[CurrentUser()] User $user,
        EntityManagerInterface $entityManager
    ) {
        $user->addCoins();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_game');
    }
}
