<?php

namespace WP\ExoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Homepage
 *
 * @ORM\Table(name="homepage")
 * @ORM\Entity(repositoryClass="WP\ExoBundle\Repository\HomepageRepository")
 */
class Homepage
{
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
     * @ORM\Column(name="titleh1", type="string", length=255, nullable=true)
     */
    private $titleh1;

    /**
     * @var string
     *
     * @ORM\Column(name="titleh2", type="string", length=255, nullable=true)
     */
    private $titleh2;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="titlelink", type="string", length=255, nullable=true)
     */
    private $titlelink;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="visitcard", type="text", nullable=true)
     */
    private $visitcard;


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
     * Set titleh1
     *
     * @param string $titleh1
     *
     * @return Homepage
     */
    public function setTitleh1($titleh1)
    {
        $this->titleh1 = $titleh1;

        return $this;
    }

    /**
     * Get titleh1
     *
     * @return string
     */
    public function getTitleh1()
    {
        return $this->titleh1;
    }

    /**
     * Set titleh2
     *
     * @param string $titleh2
     *
     * @return Homepage
     */
    public function setTitleh2($titleh2)
    {
        $this->titleh2 = $titleh2;

        return $this;
    }

    /**
     * Get titleh2
     *
     * @return string
     */
    public function getTitleh2()
    {
        return $this->titleh2;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Homepage
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
     * Set description
     *
     * @param string $description
     *
     * @return Homepage
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set titlelink
     *
     * @param string $titlelink
     *
     * @return Homepage
     */
    public function setTitlelink($titlelink)
    {
        $this->titlelink = $titlelink;

        return $this;
    }

    /**
     * Get titlelink
     *
     * @return string
     */
    public function getTitlelink()
    {
        return $this->titlelink;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Homepage
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set visitcard
     *
     * @param string $visitcard
     *
     * @return Homepage
     */
    public function setVisitcard($visitcard)
    {
        $this->visitcard = $visitcard;

        return $this;
    }

    /**
     * Get visitcard
     *
     * @return string
     */
    public function getVisitcard()
    {
        return $this->visitcard;
    }
}

