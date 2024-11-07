<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('make', TextType::class, [
                'label' => 'Make',
                 'attr' => array(
                     'placeholder' => 'Enter make...',
                 ),
                 'required' => false
            ])
            ->add('model', TextType::class, [
                'label' => 'Model',
                 'attr' => array(
                     'placeholder' => 'Enter model...',
                 ),
                 'required' => false
            ])
            ->add('year', IntegerType::class, [
                'label' => 'Year',
                 'attr' => array(
                     'placeholder' => 'Enter year...',
                 ),
                 'required' => false
            ])
            ->add('color', TextType::class, [
                'label' => 'Color',
                 'attr' => array(
                     'placeholder' => 'Enter color...',
                 ),
                 'required' => false
            ])
            ->add('transmission', ChoiceType::class, [
                'label' => 'Transmission',
                 'attr' => array(
                     'placeholder' => 'Enter transmission...',
                 ),
                'choices' => [
                    'Automatic' => 'Automatic',
                    'Manual' => 'Manual',
                ],
                 'required' => false,
            ])
             ->add('Submit', SubmitType::class, [
                 'label' => 'Submit',
                 'attr' => array(
                     'class' => 'btn btn-primary',
                 )
             ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id'   => 'car',
        ]);
    }
}
