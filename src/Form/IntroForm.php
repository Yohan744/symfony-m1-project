<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class IntroForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo', TextType::class, [
                "label" => "Pseudo"
            ])
            ->add('environment', ChoiceType::class, [
                "label" => "Type d'environnement",
                'choices'  => [
                    'Plaine' => "plain",
                    'Eau' => "water",
                    'Neige' => "snow",
                ],
            ])
            ->add('Valider', SubmitType::class)
            ->setMethod("POST")
            ->setAction('save');
    }

}