<?php

namespace Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Model\BudgetItem;

class BudgetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'items',
            CollectionType::class,
            [
                'entry_type'   => BudgetItemType::class,
                'allow_add' => true,
                'prototype' => true,
                'prototype_data' => new BudgetItem,
            ]
        )
        ->add('service', null, [
            'choice_translation_domain' => 'messages',
        ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Model\Budget'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'budget';
    }
}
