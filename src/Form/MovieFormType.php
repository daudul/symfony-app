<?php

namespace App\Form;

use App\Entity\Actor;
use App\Entity\Movie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Enter Title'
                ),
                'required' => false,
//                'label' => true
            ])
            ->add('releaseYear', IntegerType::class, [
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Enter release year'
                ),
                'required' => false
            ])
            ->add('description', TextareaType::class, [
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Enter description'
                ),
                'required' => false
            ])
            ->add('imagePath', FileType::class, ['required' => false])
//            ->add('actors', EntityType::class, [
//                'class' => Actor::class,
//                'choice_label' => 'name',
//                'attr' => array(
//                    'class' => 'form-control'
//                )
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
