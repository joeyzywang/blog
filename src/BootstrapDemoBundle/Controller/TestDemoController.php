<?php

namespace BootstrapDemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TestDemoController extends Controller
{
	/**
	 * @Route("/hello",name="bootstrapdemo_page_hello")
	 */
	public function helloAction()
	{
		return $this->render('testdemo/hello.html.twig', array(
				'name' => 'Joey'
		));
	}
}
