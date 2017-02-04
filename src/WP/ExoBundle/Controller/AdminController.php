<?php
/**
 * Created by PhpStorm.
 * User: sandman
 * Date: 18/01/17
 * Time: 21:17
 */

namespace WP\ExoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
use WP\ExoBundle\Form\SupplyType;
use WP\ExoBundle\Entity\Contact;
use WP\ExoBundle\Form\ContactType;
use WP\UserBundle\Form\UserType;

class AdminController extends Controller
{
    public function adminIndexAction(){

        $em = $this->getDoctrine()->getManager();

        $myUser = $this->getUser();

        $myAsking = $em->getRepository('WPExoBundle:Asking')->findBy([],array('id'=>'desc'));

        $mySupply = $em->getRepository('WPExoBundle:Supply')->findBy([],array('id'=>'desc'));

        $users = $em->getRepository('WPUserBundle:User')->findBy([],array('username'=>'asc'));

        $messages= $em->getRepository('WPExoBundle:Contact')->findby([],array('id'=>'desc'));

        /*findByUser($myUser)*/
        return $this->render('WPExoBundle:Admin:admin.html.twig', array(
            "myUser" => $myUser,
            "myAskings" => $myAsking,
            "mySupplys" => $mySupply,
            "users" =>$users,
            "messages"=> $messages
        ));




        //return $this->render('WPExoBundle:Admin:admin.html.twig');
    }



    public function profileDelAction($user){
        $em = $this->getDoctrine()->getManager();
        $user =  $em->getRepository('WPUserBundle:User')->findOneByusername($user);
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute('wp_exo_adminIndex');
    }

    public function userPromotAction($user){
        $em = $this->getDoctrine()->getManager();
        $user =  $em->getRepository('WPUserBundle:User')->findOneByusername($user);
        $user->setRoles(array('ROLE_USER','ROLE_ADMIN'));
        $em->flush();
        return $this->redirectToRoute('wp_exo_adminIndex');
    }
    public function homeAdminAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $home = $em->getRepository('WPExoBundle:Homepage')->findOneBy([]);

        if($home == null) {
            $home = new Homepage();
        }

        $form = $this->get('form.factory')->create(HomepageType::class,$home);

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->persist($home);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice','Données modifiées');

            return $this->redirectToRoute('wp_exo_homeAdmin');
        }

        return $this->render('WPExoBundle:Admin:homeAdmin.html.twig', array(
                'form' => $form->createView()
            )
        );
    }
}