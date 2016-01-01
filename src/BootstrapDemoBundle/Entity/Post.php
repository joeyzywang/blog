<?php

namespace BootstrapDemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne as ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn as JoinColumn;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="BootstrapDemoBundle\Repository\PostRepository")
 */
class Post
{
	/**
	 * Use constants to define configuration options that rarely change instead
	 * of specifying them in app/config/config.yml.
	 * See http://symfony.com/doc/current/best_practices/configuration.html#constants-vs-configuration-options
	 */
	const NUM_ITEMS = 10;
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="User",inversedBy="posts")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publishtime", type="datetime")
     */
    private $publishtime;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=255)
     */
    private $tag;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=255, nullable=true)
     */
    private $note;


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
     * Set title
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    
    /**
     * Set publishtime
     *
     * @param \DateTime $publishtime
     *
     * @return Post
     */
    public function setPublishtime($publishtime)
    {
        $this->publishtime = $publishtime;

        return $this;
    }

    /**
     * Get publishtime
     *
     * @return \DateTime
     */
    public function getPublishtime()
    {
        return $this->publishtime;
    }

    /**
     * Set tag
     *
     * @param string $tag
     *
     * @return Post
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Post
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set author
     *
     * @param \BootstrapDemoBundle\Entity\User $author
     *
     * @return Post
     */
    public function setAuthor(\BootstrapDemoBundle\Entity\User $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \BootstrapDemoBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
