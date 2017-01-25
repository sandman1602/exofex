<?php

namespace WP\ExoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use WP\UserBundle\Entity\User as User;

/**
 * Asking
 *
 * @ORM\Table(name="asking")
 * @ORM\Entity(repositoryClass="WP\ExoBundle\Repository\AskingRepository")
 */
class Asking {
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
	 * @ORM\Column(name="title", type="string", length=255)
	 */
	private $title;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="description", type="text")
	 */
	private $description;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="date", type="datetime")
	 */
	private $date;


    /**
     * @var boolean
     *
     * @ORM\column(name="isValidate", type="boolean", nullable=TRUE)
     */
    private $isValidate;

//	/**
//	 * @ORM\OneToOne(targetEntity="WP\ExoBundle\Entity\Image",cascade={"persist"})
//	 */
//	private $image;

    /**
     * @ORM\ManyToOne(targetEntity="WP\UserBundle\Entity\User",cascade={"persist"})
     */
    private $user;

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
	/**
    * @return mixed
    */
	public function getImage() {
	return $this->image;
	}/**
    * @param mixed $image
    */
	public function setImage( Image $image ) {
	$this->image = $image;

        return $this;
}

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
	    return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Asking
     */
    public function setTitle( $title ) {
	    $this->title = $title;

	    return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() {
	    return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Asking
     */
    public function setDescription( $description ) {
	    $this->description = $description;

	    return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
	    return $this->description;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Asking
     */
    public function setDate( $date ) {
	    $this->date = $date;

	    return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate() {
	    return $this->date;
    }

    /**
     * Set isValidate
     *
     * @param boolean $isValidate
     *
     * @return Asking
     */
    public function setIsValidate($isValidate)
    {
        $this->isValidate = $isValidate;

        return $this;
    }

    /**
     * Get isValidate
     *
     * @return boolean
     */
    public function getIsValidate()
    {
        return $this->isValidate;
    }
}
