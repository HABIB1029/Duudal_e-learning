<?php

namespace App\Form;

use App\Entity\Chapitre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ChapitreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'placeholder' => "Titre de l'annonce", 'class' => 'form-control'
                ]
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'placeholder' => "saisir une brève description", 'class' => 'form-control'
                ]
            ])
            ->add('documentExtension', FileType::class, [
                'label'=> 'fichier PDF',
                'mapped' => false,
                'required' => false,
            ])
            ->add('videoExtension', FileType::class, [
                'label'=> 'video',
                'mapped' => false,
                'required' => false,
            ])
            ->add('isAvailable', CheckboxType::class, [
                'label'    => 'disponible',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chapitre::class,
            'translation_domain' => 'forms'
        ]);
    }
}
