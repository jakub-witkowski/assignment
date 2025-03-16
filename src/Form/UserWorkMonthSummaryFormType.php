<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\WorkTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserWorkMonthSummaryFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('employee', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'getIdWithName',
            ])
            ->add('startMonth', TextType::class, [
                'label' => 'Miesiąc pracy (YYYY-MM): '
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WorkTime::class,
        ]);
    }
}
