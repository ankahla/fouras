<?php

namespace Infrastructure\Form;

use Model\Wife;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class WifeType extends AbstractPersonType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('fatherName', TextType::class, ['label' => 'Father name'])
            ->add('motherName', TextType::class, ['label' => 'Mother name'])
            ->add('mobile', TextType::class, ['label' => 'Mobile', 'required' => false])
            ->add('address', TextareaType::class, ['label' => 'Address', 'required' => false])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Wife::class]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'couple_wife_form';
    }
}
