<?php

namespace WP\ExoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SupplyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class, array ('label'=>false, 'attr'=>['placeholder'=>'Titre de l\'offre']))
            ->add('description',TextareaType::class, array ('label'=>false, 'attr'=>[
                'placeholder'=>'Déscription de l\'offre',
                'rows'=>'5'
            ]))
//            ->add('date',DateType::class, array('widget'=>'single_text'))
//            ->add('image',ImageType::class)
            /*->add('user')*/
            ->add('submit',SubmitType::class, array ('label'=>'Souscrire','attr'=>['class'=>'login-button float-l submit']))
            ->add('reset',ResetType::class, array ('label'=>'Réinitialiser','attr'=>['class'=>'login-button']))
            ->setMethod('post')
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WP\ExoBundle\Entity\Supply'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'wp_exobundle_supply';
    }


}
