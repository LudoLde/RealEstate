<?php

namespace App\Form;

use App\Entity\RealEstate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Vich\UploaderBundle\Form\Type\VichImageType;   

class RealEstateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control mt-2'
                ],
                'label' =>  'Title: (optional)',
                'label_attr' => [
                    'form-label mt-3'
                ]
            ])
            ->add('cityLocation', TextType::class, [
                'attr' => [
                    'class' => 'form-control mt-2'
                ],
                'label' =>  'City:',
                'label_attr' => [
                    'form-label mt-3'
                ]
            ])
            ->add('zipCode', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control mt-2'
                ],
                'label' =>  'ZipCode:',
                'label_attr' => [
                    'form-label mt-3'
                ]
            ])
            ->add('description', TextType::class, [
                'attr' => [
                    'class' => 'form-control mt-2'
                ],
                'label' =>  'Description:',
                'label_attr' => [
                    'form-label mt-3'
                ]
            ])
            ->add('price', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control mt-2'
                ],
                'label' =>  'Price: ($)',
                'label_attr' => [
                    'form-label mt-3'
                ]
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Upload some pictures !',
                'label_attr' => [
                    'class' => 'form-label mt-3'
                ], 'required' => false
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-secondary mt-5'
                ],
                'label' =>  'Submit it!'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RealEstate::class,
        ]);
    }
}
