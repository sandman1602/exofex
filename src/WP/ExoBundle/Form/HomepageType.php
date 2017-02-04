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
        $builder
            ->add('title1', TextType::class, array('label' => false,
                'attr' =>
                    [
                        'placeholder'=>'Slogan',
                    ]))
            ->add('titleArticle1', TextType::class, array('label' => false,
                'attr' =>
                    [
                        'placeholder'=>'Titre du 1er article',
                    ]))
            ->add('textArticle1', TextareaType::class, array('label' => false,
                'attr' =>
                    [
                        'placeholder'=>'Description du ',
                    ]))
            ->add('titleArticle2', TextType::class)
            ->add('textArticle2', TextareaType::class)
            ->add('textContactme', TextareaType::class)
            ->add('linkImg1', UrlType::class)
            ->add('img1', ImageType::class)
            ->add('linkImg2', UrlType::class)
            ->add('img2', ImageType::class)
            ->add('textLogo', TextareaType::class)
            ->add('logo', ImageType::class)
            ->add('submit', SubmitType::class)
            ->add('reset', ResetType::class);
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
