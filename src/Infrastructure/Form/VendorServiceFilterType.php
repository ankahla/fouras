<?php

namespace Infrastructure\Form;

use Model\City;
use Model\Service;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Model\VendorService;

class VendorServiceFilterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'service',
                EntityType::class,
                [
                    'label' => 'Service',
                    'class' => Service::class,
                    'choice_translation_domain' => 'messages',
                    'placeholder' => 'Select category',
                    'required' => false,
                ]
            )
            ->add(
                'city',
                EntityType::class,
                [
                'label' => 'City',
                    'class' => City::class,
                'choice_translation_domain' => 'messages',
                'placeholder' => 'Select city',
                'required' => false,
                ]
            )
            ->add(
                'costMin',
                HiddenType::class,
                [
                'label' => 'Min cost',
                'required' => false,
                'data' => 0,
                ]
            )
            ->add(
                'costMax',
                HiddenType::class,
                [
                'label' => 'Max cost',
                'required' => false,
                'data' => 1000,
                ]
            )
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => \Model\SearchVendorService::class]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'vendor_service_Filter';
    }
}
