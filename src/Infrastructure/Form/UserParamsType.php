<?php

namespace Infrastructure\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class UserParamsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', HiddenType::class)
            ->add('emailNotificationsEnabled', null, ['label' => 'Email Notifications', 'translation_domain' => 'messages', 'required' => false])
            ->add('enquiryNotificationsEnabled', null, ['label' => 'Enquiry Notifications', 'translation_domain' => 'messages', 'required' => false])
            ->add('newsletterSubscribed', null, ['label' => 'Newsletter', 'translation_domain' => 'messages', 'required' => false])
            ->add('phoneNumberHidden', null, ['label' => 'Hide phone number', 'translation_domain' => 'messages', 'required' => false])
            ->add('emailLanguage', ChoiceType::class, ['label' => 'Email language', 'choices' => ['fr' => 'fr', 'ar' => 'ar', 'en' => 'en'], 'required' => false])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => \Model\UserParams::class]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'user_params_form';
    }
}
