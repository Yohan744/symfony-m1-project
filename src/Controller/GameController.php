<?php

namespace App\Controller;

use App\Entity\Theme;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    #[Route('/game', name: 'app_game')]
    public function index(): Response
    {
        $input = "plain";
        $theme = $this->getTheme($input);

        return $this->render('game/index.html.twig', [
            'theme' => $theme,
        ]);
    }

    public function getTheme(string $themeInput): Theme
    {
        $theme = new Theme();
        $theme->setImage("images/plain.jpg");
        $theme->setPrimaryColor("#0E3120");
        $theme->setSecondaryColor("#97A27E");

        return $theme;
    }
}
