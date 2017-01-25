<?php

namespace WP\ExoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use WP\UserBundle\Entity\User as User;

/**
 * CommentSupply
 *
 * @ORM\Table(name="comment_supply")
 * @ORM\Entity(repositoryClass="WP\ExoBundle\Repository\CommentSupplyRepository")
 */
class CommentSupply
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
     * @ORM\ManyToOne(targetEntity="WP\ExoBundle\Entity\Supply",cascade={"persist"})
     */
    private $supply;



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
     * @return CommentSupply
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
     * @return CommentSupply
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
    public function getSupply()
    {
        return $this->supply;
    }

    /**
     * @param mixed $supply
     */
    public function setSupply(Supply $supply)
    {
        $this->supply = $supply;

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

