<?php

namespace WP\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use WP\ExoBundle\Form\ImageType;

class UserType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('username', null, array('label' => false, 'translation_domain' => 'FOSUserBundle','attr'=> ['placeholder'=>'Pseudo']))
            ->add('email', EmailType::class, array('label' => false, 'translation_domain' => 'FOSUserBundle', 'attr'=> ['placeholder'=>'Email']))
            ->add('adresse', TextType::class, array('label'=>false, 'attr'=>
                ['placeholder'=>'Adresse complète']))
            ->add('phone', TextType::class, array('label'=>false, 'attr'=>['placeholder'=>'N° de téléphone']))
            ->add('birth', BirthdayType::class, array('label'=>'Date de naissance', 'attr'=> ['class' => 'birthday']))
            ->add('image', ImageType::class, array('label'=>false, 'attr'=>[
                'class'=>'chooseFile'

            ]
            ))





            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => false, 'attr'=>['placeholder'=>'Mot de passe']),
                'second_options' => array('label' => false, 'attr'=>['placeholder'=>'Confirmez le mot de passe ']),
                'invalid_message' => 'Le mot de passe ne correspond pas ',
            ))
            ->add('submit', SubmitType::class, array('label' =>$options['label-type'],'attr'=>['class'=>'login-button btn']))




        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'WP\UserBundle\Entity\User',
            'label-type' => null
        ));
    }

}