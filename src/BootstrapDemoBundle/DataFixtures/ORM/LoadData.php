<?php
namespace BootstrapDemoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BootstrapDemoBundle\Entity\User;
use BootstrapDemoBundle\Entity\Post;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadData extends AbstractFixture implements FixtureInterface,ContainerAwareInterface
{	
	/** @var ContainerInterface */
	private $container;
	
	/**
	 * {@inheritdoc}
	 */
	public function setContainer(ContainerInterface $container = null)
	{
		$this->container = $container;
	}
	
	public function load(ObjectManager $manager)
	{
		$this->loadUsers($manager);
		$this->loadPosts($manager);
	}
	
	private function loadUsers(ObjectManager $manager)
	{
		$passwordEncoder = $this->container->get('security.password_encoder');
	
		$joeywang = new User();
		$joeywang->setUsername('joeywang');
		$joeywang->setEmail('joeywang@symfony.com');
		$encodedPassword = $passwordEncoder->encodePassword($joeywang, 'joeywang');
		$joeywang->setRoles(array('ROLE_ADMIN'));
		$joeywang->setPassword($encodedPassword);
// 		$joeywang->setPassword(password_hash("joeywang", PASSWORD_BCRYPT));
		$joeywang->setCreatetime(new \DateTime());
		$manager->persist($joeywang);
		
		
		
		$angli = new User();
		$angli->setUsername('angli');
		$angli->setEmail('angli@symfony.com');
		$angli->setCreatetime(new \DateTime());
		$encodedPassword = $passwordEncoder->encodePassword($angli, 'angli');
		$angli->setPassword($encodedPassword);
// 		$angli->setPassword(password_hash("angli", PASSWORD_BCRYPT));
		$manager->persist($angli);
	
		$manager->flush();
		
		$this->addReference("joeywang", $joeywang);
		$this->addReference("angli", $angli);
	}
	
	
	private function loadPosts(ObjectManager $manager)
	{
		$joeywang = $this->getReference("joeywang");
		$angli = $this->getReference("angli");
		
		foreach (range(1, 30) as $i) {
			$post = new Post();
	
			$post->setTitle($this->getRandomPostTitle());
			$post->setNote($this->getNote());
// 			$post->setSlug($this->container->get('slugger')->slugify($post->getTitle()));
			$post->setContent($this->getPostContent());
			
			
			if(rand(0, 1) == 0){
				$post->setAuthor($joeywang);
				$joeywang->addPost($post);
			}else{
				$post->setAuthor($angli);
				$angli->addPost($post);
			}
			$post->setTag($this->getTags()[rand(0, 2)]);
			$post->setPublishtime(new \DateTime('now - '.$i.'days'));
	
// 			foreach (range(1, 5) as $j) {
// 				$comment = new Comment();
	
// 				$comment->setAuthorEmail('john_user@symfony.com');
// 				$comment->setPublishedAt(new \DateTime('now + '.($i + $j).'seconds'));
// 				$comment->setContent($this->getRandomCommentContent());
// 				$comment->setPost($post);
	
// 				$manager->persist($comment);
// 				$post->addComment($comment);
// 			}
			$manager->persist($post);
		}
		$manager->persist($joeywang);
		$manager->persist($angli);
		
		
		$manager->flush();
	}
	
	private function getTags(){
		return array("TagA","TagB","TagC");
	}
	
	private function getPostContent()
	{
		return <<<MARKDOWN
Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor
incididunt ut labore et **dolore magna aliqua**: Duis aute irure dolor in
reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
deserunt mollit anim id est laborum.
	
  * Ut enim ad minim veniam
  * Quis nostrud exercitation *ullamco laboris*
  * Nisi ut aliquip ex ea commodo consequat
	
Praesent id fermentum lorem. Ut est lorem, fringilla at accumsan nec, euismod at
nunc. Aenean mattis sollicitudin mattis. Nullam pulvinar vestibulum bibendum.
Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos
himenaeos. Fusce nulla purus, gravida ac interdum ut, blandit eget ex. Duis a
luctus dolor.
	
Integer auctor massa maximus nulla scelerisque accumsan. *Aliquam ac malesuada*
ex. Pellentesque tortor magna, vulputate eu vulputate ut, venenatis ac lectus.
Praesent ut lacinia sem. Mauris a lectus eget felis mollis feugiat. Quisque
efficitur, mi ut semper pulvinar, urna urna blandit massa, eget tincidunt augue
nulla vitae est.
	
Ut posuere aliquet tincidunt. Aliquam erat volutpat. **Class aptent taciti**
sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi
arcu orci, gravida eget aliquam eu, suscipit et ante. Morbi vulputate metus vel
ipsum finibus, ut dapibus massa feugiat. Vestibulum vel lobortis libero. Sed
tincidunt tellus et viverra scelerisque. Pellentesque tincidunt cursus felis.
Sed in egestas erat.
	
Aliquam pulvinar interdum massa, vel ullamcorper ante consectetur eu. Vestibulum
lacinia ac enim vel placerat. Integer pulvinar magna nec dui malesuada, nec
congue nisl dictum. Donec mollis nisl tortor, at congue erat consequat a. Nam
tempus elit porta, blandit elit vel, viverra lorem. Sed sit amet tellus
tincidunt, faucibus nisl in, aliquet libero.
MARKDOWN;
	}
	
	private function getPhrases()
	{
		return array(
				'Lorem ipsum dolor sit amet consectetur adipiscing elit',
				'Pellentesque vitae velit ex',
				'Mauris dapibus risus quis suscipit vulputate',
				'Eros diam egestas libero eu vulputate risus',
				'In hac habitasse platea dictumst',
				'Morbi tempus commodo mattis',
				'Ut suscipit posuere justo at vulputate',
				'Ut eleifend mauris et risus ultrices egestas',
				'Aliquam sodales odio id eleifend tristique',
				'Urna nisl sollicitudin id varius orci quam id turpis',
				'Nulla porta lobortis ligula vel egestas',
				'Curabitur aliquam euismod dolor non ornare',
				'Sed varius a risus eget aliquam',
				'Nunc viverra elit ac laoreet suscipit',
				'Pellentesque et sapien pulvinar consectetur',
		);
	}
	
	private function getRandomPostTitle()
	{
		$titles = $this->getPhrases();
	
		return $titles[array_rand($titles)];
	}
	
	private function getNote()
	{
		$titles = $this->getPhrases();
	
		return $titles[array_rand($titles)];
	}
	
	private function getRandomPostSummary()
	{
		$phrases = $this->getPhrases();
	
		$numPhrases = rand(6, 12);
		shuffle($phrases);
	
		return implode(' ', array_slice($phrases, 0, $numPhrases-1));
	}
	
	private function getRandomCommentContent()
	{
		$phrases = $this->getPhrases();
	
		$numPhrases = rand(2, 15);
		shuffle($phrases);
	
		return implode(' ', array_slice($phrases, 0, $numPhrases-1));
	}
}