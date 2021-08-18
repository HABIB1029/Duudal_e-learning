<?php

namespace App\Form;

use App\Entity\Cours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('CoursTitle', TextType::class, [
                'attr' => [
                    'placeholder' => "cours", 'class' => 'form-control'
                ]
            ])
            ->add('coursDetails', TextareaType::class, [
                'attr' => [
                    'placeholder' => "details cours", 'class' => 'form-control'
                ]
            ])
            ->add('available', CheckboxType::class, [
                'label'    => 'disponible',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
