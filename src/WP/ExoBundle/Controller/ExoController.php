<?php

namespace WP\ExoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use WP\ExoBundle\Entity\Asking;
use WP\ExoBundle\Entity\CommentSupply;
use WP\ExoBundle\Entity\CommentAsking;
use WP\ExoBundle\Form\AskingType;
use WP\ExoBundle\Entity\Supply;
use WP\ExoBundle\Form\CommentSupplyType;
use WP\ExoBundle\Form\CommentAskingType;
use WP\ExoBundle\Form\SupplyType;
use WP\ExoBundle\Entity\Contact;
use WP\ExoBundle\Form\ContactType;
use WP\UserBundle\Form\UserType;

class ExoController extends Controller
{
    public function indexAction()
    {
        return $this->render('WPExoBundle:Exo:index.html.twig');
    }


    public function askingAction($page)
    {
        $em = $this->getDoctrine()->getManager();

        $nbPerPage = 8;

        $listAsking = $em->getRepository('WPExoBundle:Asking')->getPageAsking($page, $nbPerPage);

        $nbPages = ceil(count($listAsking) / $nbPerPage);

        return $this->render('WPExoBundle:Exo:asking.html.twig', array(
            "listAsking" => $listAsking,
            'nbPages' => $nbPages,
            'page' => $page
        ));
    }

    public function askingAddAction(Request $request)
    {
        $asking = new Asking();

        $form = $this->get('form.factory')->create(AskingType::class, $asking);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $asking->setUser($this->getUser());
            $em->persist($asking);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Demande souscrite.');

            return $this->redirectToRoute('wp_exo_asking');
        }


        return $this->render('WPExoBundle:Exo:askingAdd.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function askingPostAction(Request $request, $id, $page)
    {
        $em = $this->getDoctrine()->getManager();

        $asking = $em->getRepository('WPExoBundle:Asking')->find($id);
        /*$comments = $em->getRepository('WPExoBundle:CommentAsking')->findByAsking($asking,['id'=>'desc']);*/

        $nbPerPage = 8;

        $comments = $em->getRepository('WPExoBundle:CommentAsking')->getPageCommentByAsking($asking->getId(), $page, $nbPerPage);
        $nbPages = ceil(count($comments) / $nbPerPage);
        $comment = new CommentAsking();

        $form = $this->get('form.factory')->create(CommentAskingType::class, $comment);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $user = $this->getUser();
            $comment->setUser($user);

            $comment->setAsking($asking);
            $em->persist($comment);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Commentaire ajouté.');

            return $this->redirectToRoute('wp_exo_askingPost', ['id' => $asking->getId()]);
        }
        return $this->render('WPExoBundle:Exo:askingPost.html.twig', array(
            'asking' => $asking,
            'form' => $form->createView(),
            'comments' => $comments,
            'nbPages' => $nbPages,
            'page' => $page
        ));
    }

    public function askingModifAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $asking = $em->getRepository('WPExoBundle:Asking')->find($id);

        $form = $this->get('form.factory')->create(AskingType::class, $asking);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $asking->setUser($this->getUser());
            $em->persist($asking);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Demande modifiée.');

            return $this->redirectToRoute('wp_exo_profile', array(
                "user" => $this->getUser()->getUsername()
            ));
        }


        return $this->render('WPExoBundle:Exo:askingModif.html.twig', array(
            'form' => $form->createView(),
            'asking' => $asking
        ));

    }

    public function askingDelAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $asking = $em->getRepository('WPExoBundle:Asking')->find($id);
        $comments = $em->getRepository('WPExoBundle:CommentAsking')->findByAsking($asking);
        foreach ($comments as $comment) {
            $em->remove($comment);
        }

        $em->remove($asking);
        $em->flush();

        return $this->redirectToRoute('wp_exo_profile', ['user' => $this->getUser()]);

    }


    public function supplyAction($page)
    {
        $em = $this->getDoctrine()->getManager();

        $nbPerPage = 8;

        $listSupply = $em->getRepository('WPExoBundle:Supply')->getPageSupply($page, $nbPerPage);

        $nbPages = ceil(count($listSupply) / $nbPerPage);

        return $this->render('WPExoBundle:Exo:supply.html.twig', array(
            "listSupply" => $listSupply,
            'nbPages' => $nbPages,
            'page' => $page
        ));
    }

    public function supplyAddAction(Request $request)
    {
        if ($this->getUser() == null) {
            return $this->redirectToRoute('fos_user_security_login');
        }


        $supply = new Supply();


        $form = $this->get('form.factory')->create(SupplyType::class, $supply);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $supply->setUser($user);
            $em->persist($supply);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Offre souscrite.');

            return $this->redirectToRoute('wp_exo_supply');

        }


        return $this->render('WPExoBundle:Exo:supplyAdd.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function supplyPostAction(Request $request, $id, $page)
    {
        $em = $this->getDoctrine()->getManager();

        $supply = $em->getRepository('WPExoBundle:Supply')->find($id);
//        $comments = $em->getRepository('WPExoBundle:CommentSupply')->findBySupply($supply,['id'=>'desc']);


        $nbPerPage = 8;


        $comments = $em->getRepository('WPExoBundle:CommentSupply')->getPageCommentBySupply($supply->getId(), $page, $nbPerPage);
        $nbPages = ceil(count($comments) / $nbPerPage);
        $comment = new CommentSupply();


        $form = $this->get('form.factory')->create(CommentSupplyType::class, $comment);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $user = $this->getUser();
            $comment->setUser($user);

            $comment->setSupply($supply);
            $em->persist($comment);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Commentaire ajouté.');

            return $this->redirectToRoute('wp_exo_supplyPost', ['id' => $supply->getId()]);
        }


        return $this->render('WPExoBundle:Exo:supplyPost.html.twig', array(
            'supply' => $supply,
            'form' => $form->createView(),
            'comments' => $comments,
            'nbPages' => $nbPages,
            'page' => $page
        ));

    }

    public function supplyModifAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $supply = $em->getRepository('WPExoBundle:Supply')->find($id);

        $form = $this->get('form.factory')->create(SupplyType::class, $supply);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $supply->setUser($this->getUser());
            $em->persist($supply);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'offre modifiée.');

            return $this->redirectToRoute('wp_exo_profile', array(
                "user" => $this->getUser()->getUsername()
            ));


        }
        return $this->render('WPExoBundle:Exo:supplyModif.html.twig', array(
            'form' => $form->createView(),
            'supply' => $supply
        ));
    }


    public function supplyDelAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $supply = $em->getRepository('WPExoBundle:Supply')->find($id);
        $comments = $em->getRepository('WPExoBundle:CommentSupply')->findBySupply($supply);
        foreach ($comments as $comment) {
            $em->remove($comment);
        }

        $em->remove($supply);
        $em->flush();

        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            return $this->redirectToRoute('wp_exo_adminIndex');
        }
        return $this->redirectToRoute('wp_exo_profile', ['user' => $this->getUser()]);

    }


    public function contactAction(Request $request)
    {
        $contact = new Contact();

        $form = $this->get('form.factory')->create(ContactType::class, $contact);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $contact->setIsread(0);

            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Message envoyé.');

            return $this->redirectToRoute('wp_exo_contact');
        }
        return $this->render('WPExoBundle:Exo:contact.html.twig', array(
            'form' => $form->createView()
        ));
    }


    public function profileAction($user)
    {
        $em = $this->getDoctrine()->getManager();

        $myUser = $em->getRepository('WPUserBundle:User')->findOneByUsername($user);

        $myAsking = $em->getRepository('WPExoBundle:Asking')->findByUser($myUser,['id'=>'desc']);

        $mySupply = $em->getRepository('WPExoBundle:Supply')->findByUser($myUser,['id'=>'desc']);


        /*findByUser($myUser)*/
        return $this->render('WPExoBundle:Exo:profile.html.twig', array(
            "myUser" => $myUser,
            "myAskings" => $myAsking,
            "mySupplys" => $mySupply
        ));
    }

    public function profileModifAction(Request $request, $user)
    {
        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository('WPUserBundle:User')->findOneByUsername($user);

        $form = $this->get('form.factory')->create(UserType::class, $profile, ['label-type'=>'Modifier']);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {


            $em->persist($profile);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'profil modifié.');

            return $this->redirectToRoute('wp_exo_profile', array(
                "user" => $this->getUser()->getUsername()
            ));
        }
        return $this->render('WPExoBundle:Exo:profileModif.html.twig', array(
            'form' => $form->createView(),
            'profile' => $profile
        ));


    }


    public function searchAction()
    {
        $em = $this->getDoctrine()->getManager();

        $keyword = $_GET['search'];
        $filter = $_GET['filter'];
//        $page ;

        if($filter == "asking") {
            $askings = $em->getRepository('WPExoBundle:Asking')->getSearchAsking($keyword);
            $supplys = null;
            $profiles = null;
        }
        elseif ($filter == 'supply'){
            $supplys = $em->getRepository('WPExoBundle:Supply')->getSearchSupply($keyword);
            $askings = null;
            $profiles = null;
        }
        elseif ($filter == 'user'){
            $profiles = $em->getRepository('WPUserBundle:User')->getSearchUser($keyword);
            $askings = null;
            $supplys = null;
        }
        else {
            $askings = $em->getRepository('WPExoBundle:Asking')->getSearchAsking($keyword);
            $supplys = $em->getRepository('WPExoBundle:Supply')->getSearchSupply($keyword);
            $profiles = $em->getRepository('WPUserBundle:User')->getSearchUser($keyword);
        }
//        $nbpages =(int)(count($askings)+count($supplys)+count($profiles))/5;

        return $this->render('WPExoBundle:Exo:search.html.twig',array(
            'askings' => $askings,
            'supplys' => $supplys,
            'profiles'=> $profiles
//            'nbPages' => $nbpages,
//            'page' => null
        ));
    }



    public function askingPostValidAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $asking = $em->getRepository('WPExoBundle:Asking')->find($id);

        $asking->setIsValidate(1);
        $em->persist($asking);
        $em->flush();

        return new Response();
        /*Sabotage !!!*/
    }


    public function supplyPostValidAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $supply = $em->getRepository('WPExoBundle:Supply')->find($id);

        $supply->setIsValidate(1);
        $em->persist($supply);
        $em->flush();

        return new Response();

    }




//    public function mailerAction()
//    {
//
//
//         $message = \Swift_Message::newInstance()
//        ->setSubject('Hello Email')
//        ->setFrom('send@example.com')
//        ->setTo('recipient@example.com')
//        ->setBody(
//            $this->renderView(
//                // app/Resources/views/Emails/registration.html.twig
//                'Emails/registration.html.twig',
//                array('name' => $name)
//            ),
//            'text/html'
//        )
//        /*
//         * If you also want to include a plaintext version of the message
//        ->addPart(
//            $this->renderView(
//                'Emails/registration.txt.twig',
//                array('name' => $name)
//            ),
//            'text/plain'
//        )
//        */
//    ;
//    $this->get('mailer')->send($message);
//
//    return $this->render(...);
//
//    }
}





