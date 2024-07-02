<?php

namespace Infrastructure\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Model\VendorService;
use Model\VendorServiceUrl;

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
            ->add('phone', null, ['label' => 'Phone'])
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
            ->add('youtubeVideoId', null, ['label' => 'Youtube video id'])
            ->add(
                'urls',
                CollectionType::class,
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
        $resolver->setDefaults(['data_class' => \Model\VendorService::class]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'vendorservice_form';
    }
}
