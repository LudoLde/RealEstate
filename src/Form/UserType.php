<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'attr' => [
                    'class' => 'form-control mt-2'
                ],
                'label' =>  'Username:',
                'label_attr' => [
                    'form-label mt-3'
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control mt-2'
                ],
                'label' =>  'Email:',
                'label_attr' => [
                    'form-label mt-3'
                ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'attr' => [
                        'class' => 'form-control mt-2'
                    ],
                    'label' =>  'Password:',
                    'label_attr' => [
                        'form-label mt-3'
                    ]
                    ],
                    'second_options' => [
                        'attr' => [
                            'class' => 'form-control mt-2'
                        ],
                        'label' =>  'Repeat password:',
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

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
