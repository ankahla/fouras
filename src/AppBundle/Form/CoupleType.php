<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\CoupleUrl;
use AppBundle\Entity\Budget;
use AppBundle\Entity\Guest;

class CoupleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('husband', new HusbandType)
        ->add('wife', new WifeType)
        ->add('weddingDate', DateType::class, ['widget' => 'single_text'])
        ->add('weddingCity')
        ->add('urls', CollectionType::class,
            [
                'entry_type'   => CoupleUrlType::class,
                'allow_add' => true,
                'prototype' => true,
                'prototype_data' => new CoupleUrl,
            ]
        )
        ->add('budgets', CollectionType::class,
            [
                'entry_type'   => BudgetType::class,
                'allow_add' => true,
                'prototype_data' => new Budget,
            ]
        )
        ->add('guests', CollectionType::class,
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
        $resolver->setDefaults(array(
            'multipart' => true,
            'data_class' => 'AppBundle\Entity\Couple'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'couple_form';
    }


}
