<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Driver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssignmentType extends CarType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('driverid', EntityType::class, [
                'class' => Driver::class,
                'choice_label' => 'name',
            ])
            ->add('Submit', EntityType::class, [])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
