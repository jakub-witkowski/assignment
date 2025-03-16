<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\WorkTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkTimeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Definiowanie pól formularza
        $builder
            ->add('employee', EntityType::class, [
                'class' => User::class,
                'label' => 'Unikalny identyfikator pracownika: ',
                'choice_label' => 'getId',
            ])
            ->add('startAt', DateTimeType::class, [
                'label' => 'Data i godzina rozpoczęcia: ',
                'widget' => 'single_text',
                'mapped' => false,
            ] )
            ->add('endAt', DateTimeType::class, [
                'label' => 'Data i godzina zakończenia: ',
                'widget' => 'single_text',
                'mapped' => false,
            ])
        ;
    }

    // Dowiązanie formularza do encji
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WorkTime::class,
        ]);
    }
}
