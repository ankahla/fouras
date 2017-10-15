<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AppBundle\Entity\VendorUrl;

class VendorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstName')
        ->add('lastName')
        ->add('email')
        ->add('phone')
        ->add('mobile')
        ->add('city')
        ->add('address', TextareaType::class, ['required' => false])
        ->add('urls', CollectionType::class,
            [
                'entry_type'   => VendorUrlType::class,
                'allow_add' => true,
                'prototype' => true,
                'prototype_data' => new VendorUrl,
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
            'data_class' => 'AppBundle\Entity\Vendor'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'vendor_form';
    }


}
