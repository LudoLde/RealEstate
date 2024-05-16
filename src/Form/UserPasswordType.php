<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('plainPassword', PasswordType::class, [
            'attr' => [
                'class' => 'form-control mt-2'
            ],
            'label' =>  'Mot de passe:',
            'label_attr' => [
                'form-label mt-3'
            ]
        ])
        ->add('newPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'first_options' => [
                'attr' => [
                    'class' => 'form-control mt-2'
                ],
                'label' =>  'Nouveau mot de passe:',
                'label_attr' => [
                    'form-label mt-3'
                ]
                ],
                'second_options' => [
                    'attr' => [
                        'class' => 'form-control mt-2'
                    ],
                    'label' =>  'Confirmer votre nouveau mot de passe:',
                    'label_attr' => [
                        'form-label mt-3'
                    ]
                    ],
        ])
        ->add('submit', SubmitType::class, [
            'attr' => [
                'class' => 'form-control mt-5 btn btn-primary'
            ]
        ])
    ;
    }
}