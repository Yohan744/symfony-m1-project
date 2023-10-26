<?php

namespace App\Controller;

use App\Entity\Theme;
use App\FormType\ThemeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use League\ColorExtractor\Color;
use League\ColorExtractor\Palette;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;

class GameController extends AbstractController
{
    #[Route('/game', name: 'app_game')]
    public function index(KernelInterface $appKernel): Response
    {
        $input = "plain";
        $theme = $this->getTheme($input, $appKernel);

        return $this->render('game/index.html.twig', [
            'theme' => $theme,
        ]);
    }

    public function getTheme(string $themeInput, KernelInterface $appKernel): Theme
    {
        $theme = new Theme();
        $theme->setImage("images/" . $themeInput . ".jpg");

        $palette = Palette::fromFilename($appKernel->getProjectDir() . "/assets/images/" . $themeInput . ".jpg");
        $lightPalette = $palette->getMostUsedColors(1);

        foreach ($lightPalette as $color) {
            $theme->setPrimaryColor(Color::fromIntToHex($color));
        }

        $theme->setPrimaryColor(Color::fromIntToHex($color));

        return $theme;
    }
}
