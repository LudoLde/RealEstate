<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('username', TextType::class, [
            'attr' => [
                'class' => 'form-control mt-2'
            ],
            'label' =>  'Pseudo:',
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
        ->add('plainPassword', PasswordType::class,[
                'attr' => [
                    'class' => 'form-control mt-2'
                ],
                'label' =>  'Saisissez votre mot de passe:',
                'label_attr' => [
                    'form-label mt-3'
                ],
                'required' => true,
                'constraints' => [new NotBlank()]
            
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