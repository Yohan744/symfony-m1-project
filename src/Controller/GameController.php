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

        $userBuildings = $user->getBuildings()->toArray();
        foreach ($userBuildings as $a => $userBuilding) {
            $buildings = array_filter($buildings, function ($b) use ($userBuilding) {
                return $userBuilding->getId() != $b->getId();
            });
        }

        $theme = $themeRepository->findOneById($user->getTheme()->getId());

        $user->getTownHall()->getCurrentBuildingState($buildingStateRepository);

        foreach ($buildings as &$building) {
            $building->getCurrentBuildingState($buildingStateRepository);
        }
        foreach ($userBuildings as &$building) {
            $building->getCurrentBuildingState($buildingStateRepository);
        }

        return $this->render('game/index.html.twig', [
            'theme' => $theme,
            "user" => $user,
            "buildings" => $buildings,
            "userBuildings" => $userBuildings
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
    #[Route('/build/{buildId}', name: 'app_game_build', methods: ['GET'])]
    public function build(
        string $buildId,
        #[CurrentUser()] User $user,
        EntityManagerInterface $entityManager,
        BuildingRepository $buildingRepo,
        BuildingStateRepository $buildingStateRepository,
    ) {
        // if($user->coins > $building->currentS)
        $building = $buildingRepo->findOneById($buildId);
        $building->getCurrentBuildingState($buildingStateRepository);

        if ($user->getCoins() >= $building->currentState->getUpgradeCost()) {
            $building->increaseLevel();
            $user->buyBuilding($building);
            $entityManager->persist($user);
            $entityManager->flush();
        }


        return $this->redirectToRoute('app_game');
    }
    #[Route('/upgrade/{buildId}', name: 'app_game_upgrade', methods: ['GET'])]
    public function upgrade(
        string $buildId,
        #[CurrentUser()] User $user,
        EntityManagerInterface $entityManager,
        BuildingRepository $buildingRepo,
        BuildingStateRepository $buildingStateRepository,
    ) {
        // if($user->coins > $building->currentS)
        $building = $buildingRepo->findOneById($buildId);
        $building->getCurrentBuildingState($buildingStateRepository);

        if ($user->getCoins() >= $building->currentState->getUpgradeCost()) {
            $building->increaseLevel();
            $user->setCoins($user->getCoins() - $building->currentState->getUpgradeCost());
            $entityManager->persist($building);
            $entityManager->persist($user);
            $entityManager->flush();
        }


        return $this->redirectToRoute('app_game');
    }
}
