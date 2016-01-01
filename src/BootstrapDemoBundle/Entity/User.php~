<?php

namespace BootstrapDemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany as OneToMany;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="BootstrapDemoBundle\Repository\UserRepository")
 */
class User implements UserInterface
{
	public function __construct() {
		$this->posts = new ArrayCollection();
	}
	
	public function __toString()
	{
		return $this->getUsername();
	}
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;
	
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createtime", type="datetime")
     */
    private $createtime;
    
    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="author")
     */
    private $posts;
	
    /**
     * @ORM\Column(type="json_array")
     */
    private $roles = array();

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *	{@inheritdoc}
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }


    /**
     * Set createtime
     *
     * @param \DateTime $createtime
     *
     * @return User
     */
    public function setCreatetime($createtime)
    {
        $this->createtime = $createtime;

        return $this;
    }

    /**
     * Get createtime
     *
     * @return \DateTime
     */
    public function getCreatetime()
    {
        return $this->createtime;
    }

    /**
     * Add post
     *
     * @param \BootstrapDemoBundle\Entity\Post $post
     *
     * @return User
     */
    public function addPost(\BootstrapDemoBundle\Entity\Post $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \BootstrapDemoBundle\Entity\Post $post
     */
    public function removePost(\BootstrapDemoBundle\Entity\Post $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }
    
    /**
     * Returns the roles or permissions granted to the user for security.
     */
    public function getRoles()
    {
    	$roles = $this->roles;
    
    	// guarantees that a user always has at least one role for security
    	if (empty($roles)) {
    		$roles[] = 'ROLE_USER';
    	}
    
    	return array_unique($roles);
    }
    
    public function setRoles(array $roles)
    {
    	$this->roles = $roles;
    }
    
    /**
     * Returns the salt that was originally used to encode the password.
     */
    public function getSalt()
    {
    	// See "Do you need to use a Salt?" at http://symfony.com/doc/current/cookbook/security/entity_provider.html
    	// we're using bcrypt in security.yml to encode the password, so
    	// the salt value is built-in and you don't have to generate one
    
    	return null;
    }
    
    /**
     * Removes sensitive data from the user.
     */
    public function eraseCredentials()
    {
    	// if you had a plainPassword property, you'd nullify it here
    	// $this->plainPassword = null;
    }
    
}
