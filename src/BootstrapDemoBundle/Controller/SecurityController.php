<?php

namespace BootstrapDemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
	/**
	 * @Route("/login",name="bootstrapdemo_security_login")
	 */
	public function loginAction()
	{
		$helper = $this->get('security.authentication_utils');
		
		return $this->render('admin/login.html.twig', array(
				// last username entered by the user (if any)
				'last_username' => $helper->getLastUsername(),
				// last authentication error (if any)
				'error' => $helper->getLastAuthenticationError(),
		));
	}
	
	/**
	 * @Route("/login_check",name="bootstrapdemo_security_login_check")
	 */
	public function logincheckAction()
	{
		throw new \Exception("logincheckAction can't be reached !!");
	}
	
	/**
	 * @Route("/logout",name="bootstrapdemo_security_logout")
	 */
	public function logoutAction()
	{
		throw new \Exception("logoutAction can't be reached !!");
	}
}
