<?php
namespace Infrastructure\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Model\UserType;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('firstName')
            ->add('lastName')
            ->add('usertype')
        ;
        $builder->add(
            'usertype',
            EntityType::class,
            [
                'class' => UserType::class,
                'choice_label' => 'name',
                'choice_translation_domain' => 'messages',
            ]
        );
    }

    public function getName()
    {
        return 'app_user_registration_form';
    }
}
