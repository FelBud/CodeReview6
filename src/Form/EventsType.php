<?php

namespace App\Form;

use App\Entity\Events;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


class EventsType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
      $builder
          ->add('name', TextType::class, [
              'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
          ])
          ->add('name', TextType::class, [
            'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
          ])
          ->add('image', TextType::class, [
            'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
        ])
          ->add('description', TextType::class, [
              'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
          ])
          ->add('capacity', TextType::class, [
            'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
        ])
        ->add('email', TextType::class, [
            'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
        ])
        ->add('phone', TextType::class, [
            'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
        ])
        ->add('address', TextType::class, [
            'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
        ])
        ->add('zip', TextType::class, [
            'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
        ])
        ->add('city', TextType::class, [
            'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
        ])
        ->add('url', TextType::class, [
            'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
        ])
          ->add('type', ChoiceType::class, [
              'choices' => ['Music' => 'Music', 'Sport' => 'Sport', 'Movie' => 'Movie', 'Theatre' => 'Theatre'],
              'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
          ])
         ->add('date', DateTimeType::class, [
              'attr' => ['style' => 'margin-bottom:15px']
          ])
          ->add('save', SubmitType::class, [
              'label' => 'Create events',
              'attr' => ['class' => 'btn-primary', 'style' => 'margin-bottom:15px']
          ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
      $resolver->setDefaults([
          'data_class' => Events::class,
      ]);
  }
}