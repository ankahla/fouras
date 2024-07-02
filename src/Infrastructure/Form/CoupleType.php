<?php

namespace Infrastructure\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Model\CoupleUrl;
use Model\Budget;
use Model\Guest;

class CoupleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('husband', HusbandType::class)
        ->add('wife', WifeType::class)
        ->add('weddingDate', DateType::class, ['widget' => 'single_text', 'label' => 'Wedding date'])
        ->add('weddingCity', null, ['label' => 'Wedding city', 'choice_translation_domain' => 'messages'])
        ->add(
            'urls',
            CollectionType::class,
            [
                'entry_type'   => CoupleUrlType::class,
                'allow_add' => true,
                'prototype' => true,
                'prototype_data' => new CoupleUrl,
            ]
        )
        ->add(
            'budgets',
            CollectionType::class,
            [
                'entry_type'   => BudgetType::class,
                'allow_add' => true,
                'prototype_data' => new Budget,
            ]
        )
        ->add(
            'guests',
            CollectionType::class,
            [
                'entry_type'   => GuestType::class,
                'allow_add' => true,
                'prototype_data' => new Guest,
            ]
        )
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['multipart' => true, 'data_class' => \Model\Couple::class]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'couple_form';
    }
}
