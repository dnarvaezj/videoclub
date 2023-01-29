<?php

namespace App\Form;

use App\Entity\Alquileres;
use App\Entity\Peliculas;
use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AlquileresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('valortotal', NumberType::class, [
                'label' => 'Valor total',
                'attr' => [
                    'autocomplete' => 'off',
                    'class' => 'form-control valorTotal',
                    'required' => true,
                ]
            ])
            ->add('diasalquiler', ChoiceType::class, [
                'label' => 'Dias alquiler',
                'attr' => [
                    'class' => 'form-control diasAlquiler',
                    'required' => true,
                ],
                'choices' => [
                    'Seleccionar dias' => [
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6',
                        '7' => '7',
                    ]
                ],
            ])
            ->add('peliculas', EntityType::class, [
                'label' => 'Peliculas',
                'class' => Peliculas::class,
                'choice_label' => function ($peliculas) {
                    return $peliculas->getNombreYPrecio();
                },
                'multiple' => true,
                'attr' => [
                    'class' => 'form-control peliculas',
                    'required' => true,
                ],
            ])
            ->add('user', EntityType::class, [
                'label' => 'Usuario',
                'class' => Users::class,
                'choice_label' => 'fullName',
                'attr' => [
                    'class' => 'form-control',
                    'required' => true,
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Guardar',
                'attr' => [
                    'class' => 'btn btn-primary',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Alquileres::class,
        ]);
    }
}
