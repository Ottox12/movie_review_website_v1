<?php

namespace App\Form;

use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewFormType extends AbstractType
{

public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
        ->add('email', TextType::class, [
            'label' => false,
            'attr' => [
                'autocomplete' => 'email',
                'class' => 'bg-transparent block mt-10 mx-auto border-b-2 w-1/5 h-20 text-2xl outline-none',
                'placeholder' => 'Email'
            ],
        ])
        ->add('name', TextType::class, [
            'label' => false,
            'attr' => [
                'autocomplete' => 'name',
                'class' => 'bg-transparent block mt-10 mx-auto border-b-2 w-1/5 h-20 text-2xl outline-none',
                'placeholder' => 'Name'
            ],
        ])
        ->add('rating', ChoiceType::class, [
            'label' => false,
            'choices' => [
                '1 star' => 1,
                '2 stars' => 2,
                '3 stars' => 3,
                '4 stars' => 4,
                '5 stars' => 5,
            ],
        ])
        ->add('review', TextareaType::class, [
            'label' => false,
            'attr' => [
                'autocomplete' => 'review',
                'class' => 'bg-transparent block mt-10 mx-auto border-b-2 w-1/5 h-20 text-2xl outline-none',
                'placeholder' => ' Review'
            ],
        ]);

}

public function configureOptions(OptionsResolver $resolver)
{
    $resolver->setDefaults([
        'data_class' => Review::class,
    ]);
}
}