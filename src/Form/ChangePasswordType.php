<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints as Assert;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Vérifie l'ancien mdp via le hasher automatiquement
            ->add('currentPassword', PasswordType::class, [
                'label' => 'Mot de passe actuel',
                'mapped' => false,
                'constraints' => [new UserPassword(message: 'Mot de passe actuel incorrect')],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => ['label' => 'Nouveau mot de passe'],
                'second_options' => ['label' => 'Confirmer le mot de passe'],
                'mapped' => false,
                'invalid_message' => 'Les mots de passe ne correspondent pas.',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(min: 8),
                    // optionnel : complexité minimale
                    new Assert\Regex(
                        pattern: '/^(?=.*[A-Z])(?=.*\d).+$/',
                        message: 'Au moins 1 majuscule et 1 chiffre'
                    ),
                    new Assert\NotCompromisedPassword(), // vérifie HIBP
                ],
            ]);
    }
}

