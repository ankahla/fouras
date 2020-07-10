<?php

namespace Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EnquiryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => 'Your name', 'translation_domain' => 'messages'])
            ->add('email', null, ['label' => 'Email address', 'translation_domain' => 'messages'])
            ->add('phone')
            ->add('weddingDate', DateType::class, ['widget' => 'single_text', 'label' => 'Wedding date'])
            ->add('phoneCallBack', null, ['label' => 'Need Call Back', 'translation_domain' => 'messages'])
            ->add('emailResponseBack', null, ['label' => 'E-Mail', 'translation_domain' => 'messages'])
            ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Model\Enquiry'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'enquiry';
    }
}
