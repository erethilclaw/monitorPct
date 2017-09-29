<?php

namespace PctmonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use PctmonBundle\Entity\User;

class SecurityController extends Controller
{

    public function loginAction(Request $request)
    {
        $authUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();
// last username entered by the user
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('@Pctmon/UserLogin/loginForm.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));
    }

    public function indexAction()
    {
        return $this->render('@Pctmon/Default/inici.html.twig');
    }

    public function testAction(){
        $logoutDate = getdate();
        $user = $this->getUser();
        $em = $this->getDoctrine()->getEntityManager();

        $item = $em->getRepository('PersonalBundle:User')->findOneByUsername($user->getUsername());
        $item->setLastLog($logoutDate);
        $em->flush($item);


    }

}
