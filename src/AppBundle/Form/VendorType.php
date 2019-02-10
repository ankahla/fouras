<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AppBundle\Entity\VendorUrl;

class VendorType extends AbstractPersonType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
        ->add('mobile', null, ['label' => 'Mobile'])
        ->add('city', null, ['label' => 'City', 'choice_translation_domain' => 'messages'])
        ->add('address', TextareaType::class, ['label' => 'Address', 'required' => false])
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
