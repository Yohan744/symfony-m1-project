<?php

namespace App\Controller;

use App\Form\IntroForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class IntroController extends AbstractController
{
    #[Route('/', name: 'app_intro_index')]
    public function index(Request $request): Response
    {

        $form = $this->createForm(IntroForm::class, null);
        $session = $request->getSession();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pseudo = $form->get('pseudo')->getData();
            $session->set('pseudo', $pseudo);

            $environment = $form->get('environment')->getData();
            $session->set('environment', $environment);

            return $this->redirectToRoute("app_game");
        }

        return $this->render('intro/index.html.twig', ['form' => $form->createView()]);
    }

    public function submitForm(Request $request, SessionInterface $session)
    {
        $form = $this->createForm(IntroForm::class);
    }
}
