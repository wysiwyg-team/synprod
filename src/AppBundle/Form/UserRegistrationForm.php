<?php

namespace AppBundle\Form;

use AppBundle\Controller\UserController;
use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserRegistrationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array('label'=>'Votre email','label_attr'=> array('CLASS'=>'mycclass')))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Mot de passe'),
                'second_options' => array('label' => 'Enter votre mot de passe encore'),
                'invalid_message' => 'Les mots de passe ne sont pas identique.',
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' =>User::class
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_user_registration_form';
    }
}
