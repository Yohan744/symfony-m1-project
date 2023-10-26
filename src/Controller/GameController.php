<?php

namespace App\Controller;

use App\Entity\Theme;
use App\FormType\ThemeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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

        return $this->render('game/index.html.twig', [
            'theme' => $theme,
            "pseudo" => $pseudo
        ]);
    }

    public function getTheme(string $environement): Theme
    {
        $theme = new Theme();
        $theme->setImage("images/" . $environement . ".jpg");

        $theme->setPrimaryColor($environement);

        return $theme;
    }
}
