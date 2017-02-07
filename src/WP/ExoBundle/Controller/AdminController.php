<?php
/**
 * Created by PhpStorm.
 * User: sandman
 * Date: 18/01/17
 * Time: 21:17
 */

namespace WP\ExoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use WP\ExoBundle\Entity\Asking;
use WP\ExoBundle\Entity\CommentSupply;
use WP\ExoBundle\Entity\CommentAsking;
use WP\ExoBundle\Entity\Homepage;
use WP\ExoBundle\Form\AskingType;
use WP\ExoBundle\Entity\Supply;
use WP\ExoBundle\Form\CommentSupplyType;
use WP\ExoBundle\Form\CommentAskingType;
use WP\ExoBundle\Form\HomepageType;
use WP\ExoBundle\Form\ImageType;
use WP\ExoBundle\Form\SupplyType;
use WP\ExoBundle\Entity\Contact;
use WP\ExoBundle\Form\ContactType;
use WP\UserBundle\Form\UserType;
use Symfony\Component\Form\AbstractType;

class AdminController extends Controller
{
    public function adminIndexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $myUser = $this->getUser();

        $myAsking = $em->getRepository('WPExoBundle:Asking')->findBy([], array('id' => 'desc'));

        $mySupply = $em->getRepository('WPExoBundle:Supply')->findBy([], array('id' => 'desc'));

        $users = $em->getRepository('WPUserBundle:User')->findBy([], array('username' => 'asc'));

        $messages = $em->getRepository('WPExoBundle:Contact')->findby([], array('id' => 'desc'));

        /*findByUser($myUser)*/
        return $this->render('WPExoBundle:Admin:admin.html.twig', array(
            "myUser" => $myUser,
            "myAskings" => $myAsking,
            "mySupplys" => $mySupply,
            "users" => $users,
            "messages" => $messages
        ));


        //return $this->render('WPExoBundle:Admin:admin.html.twig');
    }


    public function profileDelAction($user)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('WPUserBundle:User')->findOneByusername($user);
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute('wp_exo_adminIndex');
    }

    public function userPromotAction($user)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('WPUserBundle:User')->findOneByusername($user);
        $user->setRoles(array('ROLE_USER', 'ROLE_ADMIN'));
        $em->flush();
        return $this->redirectToRoute('wp_exo_adminIndex');
    }

    public function homeAdminAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $home = $em->getRepository('WPExoBundle:Homepage')->findOneBy([]);

        if ($home == null) {
            $home = new Homepage();
        }

//       $form = $this->get('form.factory')->create(HomepageType::class,$home);
        $formTitle1 = $this->get('form.factory')->createNamedBuilder('form_title1', FormType::class, $home, ['data_class' => 'WP\ExoBundle\Entity\Homepage'])
            ->add('title1', TextType::class, array('label' => false,
                'attr' =>
                    [
                        'placeholder' => 'Slogan',
                    ]))
            ->add('submit', SubmitType::class, array('label' => 'Modifier', 'attr' => ['class' => 'login-button float-l submit']))
            ->add('reset', ResetType::class, array('label' => 'Réinitialiser', 'attr' => ['class' => 'login-button']))
            ->getForm();
        $formTitleArticle1 = $this->get('form.factory')->createNamedBuilder('form_TitleArticle1', FormType::class, $home, ['data_class' => 'WP\ExoBundle\Entity\Homepage'])
            ->add('titleArticle1', TextType::class, array('label' => false,
                'attr' =>
                    [
                        'placeholder' => 'Titre du 1er article',
                    ]))
            ->add('submit', SubmitType::class, array('label' => 'Modifier', 'attr' => ['class' => 'login-button float-l submit']))
            ->add('reset', ResetType::class, array('label' => 'Réinitialiser', 'attr' => ['class' => 'login-button']))
            ->getForm();

        $formTextArticle1 = $this->get('form.factory')->createNamedBuilder('form_TextArticle1', FormType::class, $home, ['data_class' => 'WP\ExoBundle\Entity\Homepage'])
            ->add('textArticle1', TextareaType::class, array('label' => false,
                'attr' =>
                    [
                        'placeholder' => 'Description du 1er article',
                        'rows' => '4',
                        'maxlength' => '225'
                    ]))
            ->add('submit', SubmitType::class, array('label' => 'Modifier', 'attr' => ['class' => 'login-button float-l submit']))
            ->add('reset', ResetType::class, array('label' => 'Réinitialiser', 'attr' => ['class' => 'login-button']))
            ->getForm();

        $formTitleArticle2 = $this->get('form.factory')->createNamedBuilder('form_TitleArticle2', FormType::class, $home, ['data_class' => 'WP\ExoBundle\Entity\Homepage'])
            ->add('titleArticle2', TextType::class, array('label' => false,
                'attr' =>
                    [
                        'placeholder' => 'Titre du second article',
                    ]))
            ->add('submit', SubmitType::class, array('label' => 'Modifier', 'attr' => ['class' => 'login-button float-l submit']))
            ->add('reset', ResetType::class, array('label' => 'Réinitialiser', 'attr' => ['class' => 'login-button']))
            ->getForm();

        $formTextArticle2 = $this->get('form.factory')->createNamedBuilder('form_TextArticle2', FormType::class, $home, ['data_class' => 'WP\ExoBundle\Entity\Homepage'])
            ->add('textArticle2', TextareaType::class, array('label' => false,
                'attr' =>
                    [
                        'placeholder' => 'Description du second article',
                        'rows' => '4',
                        'maxlength' => '225'
                    ]))
            ->add('submit', SubmitType::class, array('label' => 'Modifier', 'attr' => ['class' => 'login-button float-l submit']))
            ->add('reset', ResetType::class, array('label' => 'Réinitialiser', 'attr' => ['class' => 'login-button']))
            ->getForm();

        $formTextContactMe = $this->get('form.factory')->createNamedBuilder('form_TextContactMe', FormType::class, $home, ['data_class' => 'WP\ExoBundle\Entity\Homepage'])
            ->add('textContactme', TextareaType::class, array('label' => false,
                'attr' =>
                    [
                        'placeholder' => 'Annonce de la page contact',
                        'rows' => '4',
                        'maxlength' => '185'
                    ]))
            ->add('submit', SubmitType::class, array('label' => 'Modifier', 'attr' => ['class' => 'login-button float-l submit']))
            ->add('reset', ResetType::class, array('label' => 'Réinitialiser', 'attr' => ['class' => 'login-button']))
            ->getForm();

        $formExternalLink1 = $this->get('form.factory')->createNamedBuilder('form_ExternalLink1', FormType::class, $home, ['data_class' => 'WP\ExoBundle\Entity\Homepage'])
            ->add('linkImg1', UrlType::class, array('label' => false,
                'attr' =>
                    [
                        'placeholder' => 'Lien vers le 1er site',
                    ]))
            ->add('img1', ImageType ::class, array('label' => false, 'required' => false,
                'attr' => [
                    'class' => 'chooseFile'

                ]
            ))
            ->add('submit', SubmitType::class, array('label' => 'Modifier', 'attr' => ['class' => 'login-button float-l submit']))
            ->add('reset', ResetType::class, array('label' => 'Réinitialiser', 'attr' => ['class' => 'login-button']))
            ->getForm();

        $formExternalLink2 = $this->get('form.factory')->createNamedBuilder('form_ExternalLink2', FormType::class, $home, ['data_class' => 'WP\ExoBundle\Entity\Homepage'])
            ->add('linkImg2', UrlType::class, array('label' => false,
                'attr' =>
                    [
                        'placeholder' => 'Lien vers le second site',
                    ]))
            ->add('img2', ImageType ::class, array('label' => false, 'required' => false,
                'attr' => [
                    'class' => 'chooseFile'

                ]
            ))
            ->add('submit', SubmitType::class, array('label' => 'Modifier', 'attr' => ['class' => 'login-button float-l submit']))
            ->add('reset', ResetType::class, array('label' => 'Réinitialiser', 'attr' => ['class' => 'login-button']))
            ->getForm();

        $formRules = $this->get('form.factory')->createNamedBuilder('form_Rules', FormType::class, $home, ['data_class' => 'WP\ExoBundle\Entity\Homepage'])
            ->add('textLogo', TextareaType::class, array('label' => false,
                'attr' =>
                    [
                        'placeholder' => 'Règles du site',
                        'rows' => '6',
                        'maxlength' => '500'
                    ]))
            ->add('submit', SubmitType::class, array('label' => 'Modifier', 'attr' => ['class' => 'login-button float-l submit']))
            ->add('reset', ResetType::class, array('label' => 'Réinitialiser', 'attr' => ['class' => 'login-button']))
            ->getForm();

        $formLogo = $this->get('form.factory')->createNamedBuilder('form_Logo', FormType::class, $home, ['data_class' => 'WP\ExoBundle\Entity\Homepage'])
            ->add('logo', ImageType ::class, array('label' => false, 'required' => false,
                'attr' => [
                    'class' => 'chooseFile'

                ]
            ))
            ->add('submit', SubmitType::class, array('label' => 'Modifier', 'attr' => ['class' => 'login-button float-l submit']))
            ->add('reset', ResetType::class, array('label' => 'Réinitialiser', 'attr' => ['class' => 'login-button']))
            ->getForm();


        $formTitle1->handleRequest($request);
        $formTitleArticle1->handleRequest($request);
        $formTextArticle1->handleRequest($request);
        $formTitleArticle2->handleRequest($request);
        $formTextArticle2->handleRequest($request);
        $formTextContactMe->handleRequest($request);
        $formExternalLink1->handleRequest($request);
        $formExternalLink2->handleRequest($request);
        $formRules->handleRequest($request);
        $formLogo->handleRequest($request);
        $verification =
            (
                ($formTitle1->isSubmitted() AND $formTitle1->isValid()) OR
                ($formTitleArticle1->isSubmitted() AND $formTitleArticle1->isValid()) OR
                ($formTextArticle1->isSubmitted() AND $formTextArticle1->isValid()) OR
                ($formTitleArticle2->isSubmitted() AND $formTitleArticle2->isValid()) OR
                ($formTextArticle2->isSubmitted() AND $formTextArticle2->isValid()) OR
                ($formTextContactMe->isSubmitted() AND $formTextContactMe->isValid()) OR
                ($formExternalLink1->isSubmitted() AND $formExternalLink1->isValid()) OR
                ($formExternalLink2->isSubmitted() AND $formExternalLink2->isValid()) OR
                ($formRules->isSubmitted() AND $formRules->isValid()) OR
                ($formLogo->isSubmitted() AND $formLogo->isValid())
            );

        if ($verification) {
            $em->persist($home);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Données modifiées');
            return $this->redirectToRoute('wp_exo_homeAdmin');
        }

        return $this->render('WPExoBundle:Admin:homeAdmin.html.twig', array(
                'formTitle1' => $formTitle1->createView(),
                'formTitleArticle1' => $formTitleArticle1->createView(),
                'formTextArticle1' => $formTextArticle1->createView(),
                'formTitleArticle2' => $formTitleArticle2->createView(),
                'formTextArticle2' => $formTextArticle2->createView(),
                'formTextContactMe' => $formTextContactMe->createView(),
                'formExternalLink1' => $formExternalLink1->createView(),
                'formExternalLink2' => $formExternalLink2->createView(),
                'formRules' => $formRules->createView(),
                'formLogo' => $formLogo->createView()
            )
        );


    }
}