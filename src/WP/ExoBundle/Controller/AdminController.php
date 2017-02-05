<?php
/**
 * Created by PhpStorm.
 * User: sandman
 * Date: 18/01/17
 * Time: 21:17
 */

namespace WP\ExoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

//        $form = $this->get('form.factory')->create(HomepageType::class,$home);
//        $formTitle1 = $this -> get('form.factory')->createNamed('form_title1',null,$home,['data_class'=>'WP\ExoBundle\Entity\Homepage'])
        $formTitle1 = $this->get('form.factory')->createNamed('form_title1', HomepageType::class, null, ['data_class' => null])
            ->add('title1', TextType::class, array('label' => false,
                'attr' =>
                    [
                        'placeholder' => 'Slogan',
                    ]))
            ->add('submit', SubmitType::class, array('label' =>'Modifier','attr'=>['class'=>'login-button float-l submit']))
            ->add('reset', ResetType::class, array('label' =>'Réinitialiser','attr'=>['class'=>'login-button']));
        $formTitleArticle1 = $this->get('form.factory')->createNamed('form_TitleArticle1', HomepageType::class, null, ['data_class' => null])
            ->add('titleArticle1', TextType::class, array('label' => false,
                'attr' =>
                    [
                        'placeholder' => 'Titre du 1er article',
                    ]))
            ->add('submit', SubmitType::class, array('label' =>'Modifier','attr'=>['class'=>'login-button float-l submit']))
            ->add('reset', ResetType::class, array('label' =>'Réinitialiser','attr'=>['class'=>'login-button']));
        $formTextArticle1 = $this->get('form.factory')->createNamed('form_TextArticle1', HomepageType::class, null, ['data_class' => null])
            ->add('textArticle1', TextareaType::class, array('label' => false,
                'attr' =>
                    [
                        'placeholder' => 'Description du 1er article',
                        'rows'=>'4',
                        'maxlength'=>'225'
                    ]))
            ->add('submit', SubmitType::class, array('label' =>'Modifier','attr'=>['class'=>'login-button float-l submit']))
            ->add('reset', ResetType::class, array('label' =>'Réinitialiser','attr'=>['class'=>'login-button']));
        $formTitleArticle2 = $this->get('form.factory')->createNamed('form_TitleArticle2', HomepageType::class, null, ['data_class' => null])
            ->add('titleArticle2', TextType::class, array('label' => false,
                'attr' =>
                    [
                        'placeholder' => 'Titre du second article',
                    ]))
            ->add('submit', SubmitType::class, array('label' =>'Modifier','attr'=>['class'=>'login-button float-l submit']))
            ->add('reset', ResetType::class, array('label' =>'Réinitialiser','attr'=>['class'=>'login-button']));
        $formTextArticle2 = $this->get('form.factory')->createNamed('form_TextArticle2', HomepageType::class, null, ['data_class' => null])
            ->add('textArticle2', TextareaType::class, array('label' => false,
                'attr' =>
                    [
                        'placeholder' => 'Description du second article',
                        'rows'=>'4',
                        'maxlength'=>'225'
                    ]))
            ->add('submit', SubmitType::class, array('label' =>'Modifier','attr'=>['class'=>'login-button float-l submit']))
            ->add('reset', ResetType::class, array('label' =>'Réinitialiser','attr'=>['class'=>'login-button']));
        $formTextContactMe = $this->get('form.factory')->createNamed('form_TextContactMe', HomepageType::class, null, ['data_class' => null])
            ->add('textContactme', TextareaType::class, array('label' => false,
                'attr' =>
                    [
                        'placeholder' => 'Annonce de la page contact',
                        'rows'=>'4',
                        'maxlength'=>'185'
                    ]))
            ->add('submit', SubmitType::class, array('label' =>'Modifier','attr'=>['class'=>'login-button float-l submit']))
            ->add('reset', ResetType::class, array('label' =>'Réinitialiser','attr'=>['class'=>'login-button']));
        $formExternalLink1 = $this->get('form.factory')->createNamed('form_ExternalLink1', HomepageType::class, null, ['data_class' => null])
            ->add('linkImg1', UrlType::class, array('label' => false,
                'attr' =>
                    [
                        'placeholder' => 'Lien vers le 1er site',
                    ]))
            ->add('img1', ImageType ::class, array ('label'=> false, 'required'=>false))
            ->add('submit', SubmitType::class, array('label' =>'Modifier','attr'=>['class'=>'login-button float-l submit']))
            ->add('reset', ResetType::class, array('label' =>'Réinitialiser','attr'=>['class'=>'login-button']));
        $formExternalLink2 = $this->get('form.factory')->createNamed('form_ExternalLink2', HomepageType::class, null, ['data_class' => null])
            ->add('linkImg2', UrlType::class, array('label' => false,
                'attr' =>
                    [
                        'placeholder' => 'Lien vers le second site',
                    ]))
            ->add('img2', ImageType ::class, array ('label'=> false, 'required'=>false))
            ->add('submit', SubmitType::class, array('label' =>'Modifier','attr'=>['class'=>'login-button float-l submit']))
            ->add('reset', ResetType::class, array('label' =>'Réinitialiser','attr'=>['class'=>'login-button']));
        $formRules = $this->get('form.factory')->createNamed('form_Rules', HomepageType::class, null, ['data_class' => null])
            ->add('textLogo', TextareaType::class, array('label' => false,
                'attr' =>
                    [
                        'placeholder' => 'Règles du site',
                        'rows'=>'6',
                        'maxlength'=>'500'
                    ]))
            ->add('logo', ImageType ::class, array ('label'=> false, 'required'=>false))
            ->add('submit', SubmitType::class, array('label' =>'Modifier','attr'=>['class'=>'login-button float-l submit']))
            ->add('reset', ResetType::class, array('label' =>'Réinitialiser','attr'=>['class'=>'login-button']));


        if ($request->isMethod('POST') && $formTitle1 && $formTitleArticle1 && $formTextArticle1 && $formTitleArticle2 && $formTextArticle2 && $formTextContactMe && $formExternalLink1 && $formExternalLink2 && $formRules->handleRequest($request)->isValid()) {
            $em->persist($home);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Données modifiées');

            return $this->redirectToRoute('wp_exo_homeAdmin');
        }

        return $this->render('WPExoBundle:Admin:homeAdmin.html.twig', array(
//                'form' => $form->createView()
                'formTitle1' => $formTitle1->createView(),
                'formTitleArticle1' => $formTitleArticle1->createView(),
                'formTextArticle1' => $formTextArticle1->createView(),
                'formTitleArticle2' => $formTitleArticle2->createView(),
                'formTextArticle2' => $formTextArticle2->createView(),
                'formTextContactMe' => $formTextContactMe->createView(),
                'formExternalLink1' => $formExternalLink1-> createView(),
                'formExternalLink2' => $formExternalLink2-> createView(),
                'formRules'=> $formRules->createView()
            )
        );


    }
}