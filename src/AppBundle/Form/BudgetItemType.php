<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class BudgetItemType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => 'Title'])
            ->add('budget', null, ['label' => 'Budget Category', 'choice_translation_domain' => 'messages'])
            ->add('estimatedAmount', MoneyType::class, ['label' => 'Estimated Cost'])
            ->add('actuelAmount', MoneyType::class, ['label' => 'Actual Cost'])
            ->add('paidAmount', MoneyType::class, ['label' => 'Paid'])
            ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\BudgetItem'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'budgetitem';
    }


}
