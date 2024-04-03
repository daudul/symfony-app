<?php

namespace App\Form;

use App\Entity\Course;
use App\Entity\Student;
use App\Repository\CourseRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
//        dd($options['select_option']);
        $builder
            ->add('name', TextType::class, [
                'attr' => array(
                    'class' => 'form-control',
                )
            ])
            ->add('roll', IntegerType::class,[
                'attr' => array(
                    'class' => 'form-control',
                )
            ])
            ->add('courseId', EntityType::class, [
                'class' => Course::class,
                'choice_label' => 'name',
                'attr' => array(
                    'class' => 'form-control'
                ),
                'placeholder' => 'Select One',
                'data' => $options['select_option'],

            ])
            ->add('joinDate', null, [
                'widget' => 'single_text',
                'attr' => array(
                    'class' => 'form-control'
                )
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
            'select_option' =>null
        ]);
    }
}
