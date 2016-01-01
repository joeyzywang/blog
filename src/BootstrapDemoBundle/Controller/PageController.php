<?php

namespace BootstrapDemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BootstrapDemoBundle\Entity\Post;

class PageController extends Controller {
	/**
	 * @Route("/index", name="bootstrapdemo_page_index")
	 * @Route("/",name="bootstrapdemo_page_home")
	 */
	public function indexAction() {
		return $this->render ( 'blog/index.html.twig', array () );
	}
	
	/**
	 * @Route("/blog",name="bootstrapdemo_page_blog",defaults={"page"=1})
	 * @Route("/blog/page/{page}",name="bootstrapdemo_page_blog_pagination",requirements={"page" : "\d+"})
	 */
	public function blogAction($page) {
		$em = $this->getDoctrine()->getManager();
		$dql = "SELECT p FROM BootstrapDemoBundle:Post p ORDER BY p.publishtime DESC";
		$query = $em->createQuery ( $dql );
		
		$paginator = $this->get ( 'knp_paginator' );
		$post_paginated = $paginator->paginate ( 
				$query, /* query NOT result */
        		$page/*page number*/,
        		Post::NUM_ITEMS/*limit per page*/
    	);
		$post_paginated->setUsedRoute("bootstrapdemo_page_blog_pagination");
		return $this->render ( 'blog/blog.html.twig', array (
				'name' => 'Joey' ,
				'posts' => $post_paginated
		) );
	}
	
	/**
	 * @Route("/about",name="bootstrapdemo_page_about")
	 */
	public function aboutAction() {
		return $this->render ( 'blog/about.html.twig', array (
				'name' => 'Joey' 
		) );
	}
	
	/**
	 * @Route("/blogshow",name="bootstrapdemo_page_blogshow")
	 */
	public function blogshowAction() {
		return $this->render ( 'blog/blogshow.html.twig', array (
				'name' => 'Joey' 
		) );
	}
}
