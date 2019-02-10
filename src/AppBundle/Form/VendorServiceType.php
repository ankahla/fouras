<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AppBundle\Entity\VendorService;
use AppBundle\Entity\VendorServiceUrl;

class VendorServiceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('title', null, ['label' => 'Title'])
            ->add('service', null, ['label' => 'Service', 'choice_translation_domain' => 'messages'])
            ->add('city', null, ['label' => 'City', 'choice_translation_domain' => 'messages'])
            ->add('costMin', null, ['label' => 'Min cost'])
            ->add('costMax', null, ['label' => 'Max cost'])
            ->add('email', null, ['label' => 'Email'])
            ->add('description', TextareaType::class, ['label' => 'Description', 'required' => false])
            ->add('address', TextareaType::class, ['label' => 'Address', 'required' => false])
            ->add('latitude')
            ->add('longitude')
            ->add('capacity', null, ['label' => 'capacity', 'choice_translation_domain' => 'messages'])
            ->add('vendor')
            ->add('picture', FileType::class, ['label' => 'Picture'])
            ->add('urls', CollectionType::class,
                [
                    'entry_type'   => VendorServiceUrlType::class,
                    'allow_add' => true,
                    'prototype' => true,
                    'prototype_data' => new VendorServiceUrl,
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
            'data_class' => 'AppBundle\Entity\VendorService'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'vendorservice_form';
    }


}
