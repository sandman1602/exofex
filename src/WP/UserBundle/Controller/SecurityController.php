<?php

namespace WP\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use FOS\UserBundle\Controller\SecurityController as Controller;
use WP\UserBundle\Entity\User;
use WP\UserBundle\Form\UserType;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('wp_exo_homepage');
        }
        $authenticationUtils = $this->get('security.authentication_utils');

        $user = new User();
        $em = $this->getDoctrine()->getManager();
        $form = $this->get('form.factory')->create(UserType::class, $user, ['label-type'=>'S\'inscire']);
        $msgError = null;

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $existUserEmail = $em->getRepository('WPUserBundle:User')->findOneByEmail($user->getEmail());
            $existUsername = $em->getRepository('WPUserBundle:User')->findOneByUsername($user->getUsername());

            if ($existUserEmail == null) {
                if ($existUsername == null) {
                    $user->setEnabled(1);
                    $em->persist($user);
                    $em->flush();

                    $request->getSession()->getFlashBag()->add('notice', 'Message bien enregistré.');

                    return $this->redirectToRoute('fos_user_security_login');
                } else {
                    $msgError = 'Ce nom d\'utilisateur existe déjà.';
                }
            } else {
                $msgError = 'Cet address mail est déjà utilisé sur le site.';
            }
        }

        return $this->render('WPUserBundle:Security:registlogin.html.twig',array(
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'form' => $form->createView(),
            'msgError'=> $msgError
        ));
    }

}
