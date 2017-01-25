<?php

namespace WP\ExoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, array ('label'=>false, 'attr'=>['placeholder'=>'Nom & Prénom']))
            ->add('phone',TextType::class, array ('label'=>false, 'attr'=>['placeholder'=>'Numéro de téléphone']))
            ->add('mail',EmailType::class, array ('label'=>false, 'attr'=>['placeholder'=>'Adresse mail']))
            ->add('message',TextareaType::class, array ('label'=>false, 'attr'=>[
                'placeholder'=>'Ecrivez votre requête',
                'rows'=>'8'
            ]))
            /*->add('isread')*/
            ->add('submit',SubmitType::class, array('label' =>'Envoyer','attr'=>['class'=>'login-button float-l submit']))
            ->add('reset',ResetType::class, array('label' =>'Réinitialiser','attr'=>['class'=>'login-button']))
            ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WP\ExoBundle\Entity\Contact'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'wp_exobundle_contact';
    }


}
