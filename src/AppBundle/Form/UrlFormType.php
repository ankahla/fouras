<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Url;

class UrlFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('url', UrlType::class, [
            'required' => false
            ])
        ->add('type', ChoiceType::class, 
            [
                'choices' => [
                    Url::FB_TYPE => Url::FB_TYPE,
                    Url::TW_TYPE => Url::TW_TYPE,
                    Url::YT_TYPE => Url::YT_TYPE,
                    Url::IN_TYPE => Url::IN_TYPE,
                    Url::IG_TYPE => Url::IG_TYPE,
                    Url::X_TYPE => Url::X_TYPE,
                ]
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
            'data_class' => 'AppBundle\Entity\Url'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_url';
    }


}
