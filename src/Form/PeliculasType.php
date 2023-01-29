<?php

namespace App\Form;

use App\Entity\Peliculas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PeliculasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
                'label' => 'Nombre',
                'attr' => [
                    'placeholder' => 'Nombre',
                    'autocomplete' => 'off',
                    'class' => 'form-control col-md-6',
                    'required' => true,
                ]
            ])
            ->add('sinopsis', TextType::class, [
                'label' => 'Sinopsis',
                'attr' => [
                    'placeholder' => 'Sinopsis',
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                    'required' => true,
                ]
            ])
            ->add('precio', TextType::class, [
                'label' => 'Precio',
                'attr' => [
                    'placeholder' => 'Precio',
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                    'required' => true,
                ]
            ])
            ->add('genero', TextType::class, [
                'label' => 'Genero',
                'attr' => [
                    'placeholder' => 'Genero',
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                    'required' => true,
                ]
            ])
            ->add('fechaestreno', DateType::class, [
                'label' => 'Fecha de Estreno',
                'years' => range(date('Y'), date('Y')-100),
                'attr' => [
                    'widget' => 'choice',
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                    'required' => true,
                ]
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
            'data_class' => Peliculas::class,
        ]);
    }
}
