<?php

namespace App\Controller;

use App\Form\IntroForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class IntroController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(Request $request): Response {

        $form = $this->createForm(IntroForm::class, null);
        $this->submitForm($request, $request->getSession());
        return $this->render('intro/index.html.twig', ['form' => $form->createView()]);

    }

    public function submitForm(Request $request, SessionInterface $session)
    {
        // Créez un objet de formulaire et traitez-le comme d'habitude.
        $form = $this->createForm(IntroForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $session->set('introFormData', $formData);
        }

    }

}