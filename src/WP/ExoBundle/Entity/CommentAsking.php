<?php

namespace WP\ExoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use WP\UserBundle\Entity\User as User;

/**
 * CommentAsking
 *
 * @ORM\Table(name="comment_asking")
 * @ORM\Entity(repositoryClass="WP\ExoBundle\Repository\CommentAskingRepository")
 */
class CommentAsking
{
    public function __construct() {
        $this->date = new \Datetime();
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
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne("WP\ExoBundle\Entity\Asking",cascade={"persist"})
     */
    private $asking;

    /**
     * @ORM\ManyToOne("WP\UserBundle\Entity\User",cascade={"persist"})
     */
    private $user;

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
     * Set comment
     *
     * @param string $comment
     *
     * @return CommentAsking
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return CommentAsking
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getAsking()
    {
        return $this->asking;
    }

    /**
     * @param mixed $asking
     */
    public function setAsking(Asking $asking)
    {
        $this->asking = $asking;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }
}

