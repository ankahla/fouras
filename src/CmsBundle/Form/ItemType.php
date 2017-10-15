<?php

namespace CmsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ItemType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('slug')
            ->add('intro')
            ->add('content')
            ->add('extraData')
            ->add('category')
            ->add('coverImage')
            ->add('media')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CmsBundle\Entity\Item'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cmsbundle_item';
    }
}
