<?php

namespace WP\ExoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use WP\ExoBundle\Form\ImageType;

class HomepageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $builder
//            ->add('title1', TextType::class, array('label' => false,
//                'attr' =>
//                    [
//                        'placeholder'=>'Slogan',
//                    ]))
//            ->add('titleArticle1', TextType::class, array('label' => false,
//                'attr' =>
//                    [
//                        'placeholder'=>'Titre du 1er article',
//                    ]))
//            ->add('textArticle1', TextareaType::class, array('label' => false,
//                'attr' =>
//                    [
//                        'placeholder'=>'Description du 1er article ',
//                    ]))
//            ->add('titleArticle2', TextType::class, array('label' => false,
//                'attr' =>
//                    [
//                        'placeholder'=>'Titre du second article',
//                    ]))
//            ->add('textArticle2', TextareaType::class, array('label' => false,
//                'attr' =>
//                    [
//                        'placeholder'=>'Description du second article ',
//                    ]))
//            ->add('textContactme', TextareaType::class, array('label' => false,
//                'attr' =>
//                    [
//                        'placeholder'=>'Annonce de la page contact ',
//                    ]))
//            ->add('linkImg1', UrlType::class, array('label' => false,
//                'attr' =>
//                    [
//                        'placeholder'=>'Url du 1er site',
//                    ]))
//            ->add('img1', ImageType::class, array('label' => false))
//            ->add('linkImg2', UrlType::class, array('label' => false,
//                'attr' =>
//                    [
//                        'placeholder'=>'Url du second site',
//                    ]))
//            ->add('img2', ImageType::class, array('label' => false))
//            ->add('textLogo', TextareaType::class, array('label' => false,
//                'attr' =>
//                    [
//                        'placeholder'=>'Règle du site',
//                    ]))
//            ->add('logo', ImageType::class, array('label' => false))
//            ->add('submit', SubmitType::class, array('label' =>'Envoyer','attr'=>['class'=>'login-button float-l submit']))
//            ->add('reset', ResetType::class, array('label' =>'Réinitialiser','attr'=>['class'=>'login-button']));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WP\ExoBundle\Entity\Homepage'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'wp_exobundle_homepage';
    }


}
