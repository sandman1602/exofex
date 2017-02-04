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
     * @ORM\Column(name="title1", type="string", length=255)
     */
    private $title1;

    /**
     * @var string
     *
     * @ORM\Column(name="titleArticle1", type="string", length=255)
     */
    private $titleArticle1;

    /**
     * @var string
     *
     * @ORM\Column(name="textArticle1", type="text")
     */
    private $textArticle1;

    /**
     * @var string
     *
     * @ORM\Column(name="titleArticle2", type="string", length=255)
     */
    private $titleArticle2;

    /**
     * @var string
     *
     * @ORM\Column(name="textArticle2", type="text")
     */
    private $textArticle2;



    /**
     * @var string
     *
     * @ORM\Column(name="textContactme", type="text")
     */
    private $textContactme;

    /**
     * @ORM\OneToOne(targetEntity="WP\ExoBundle\Entity\Image",cascade={"persist"})
     */
    private $img1;

    /**
     * @var string
     *
     * @ORM\Column(name="linkImg1", type="string", length=255)
     */
    private $linkImg1;

    /**
     * @ORM\OneToOne(targetEntity="WP\ExoBundle\Entity\Image",cascade={"persist"})
     */
    private $img2;

    /**
     * @var string
     *
     * @ORM\Column(name="linkImg2", type="string", length=255)
     */
    private $linkImg2;

    /**
     * @var string
     *
     * @ORM\Column(name="textLogo", type="text")
     */
    private $textLogo;

    /**
     * @ORM\OneToOne(targetEntity="WP\ExoBundle\Entity\Image",cascade={"persist"})
     */
    private $logo;


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
     * Set title1
     *
     * @param string $title1
     *
     * @return Homepage
     */
    public function setTitle1($title1)
    {
        $this->title1 = $title1;

        return $this;
    }

    /**
     * Get title1
     *
     * @return string
     */
    public function getTitle1()
    {
        return $this->title1;
    }

    /**
     * Set titleArticle1
     *
     * @param string $titleArticle1
     *
     * @return Homepage
     */
    public function setTitleArticle1($titleArticle1)
    {
        $this->titleArticle1 = $titleArticle1;

        return $this;
    }

    /**
     * Get titleArticle1
     *
     * @return string
     */
    public function getTitleArticle1()
    {
        return $this->titleArticle1;
    }

    /**
     * Set textArticle1
     *
     * @param string $textArticle1
     *
     * @return Homepage
     */
    public function setTextArticle1($textArticle1)
    {
        $this->textArticle1 = $textArticle1;

        return $this;
    }

    /**
     * Get textArticle1
     *
     * @return string
     */
    public function getTextArticle1()
    {
        return $this->textArticle1;
    }

    /**
     * Set titleArticle2
     *
     * @param string $titleArticle2
     *
     * @return Homepage
     */
    public function setTitleArticle2($titleArticle2)
    {
        $this->titleArticle2 = $titleArticle2;

        return $this;
    }

    /**
     * Get titleArticle2
     *
     * @return string
     */
    public function getTitleArticle2()
    {
        return $this->titleArticle2;
    }

    /**
     * Set textArticle2
     *
     * @param string $textArticle2
     *
     * @return Homepage
     */
    public function setTextArticle2($textArticle2)
    {
        $this->textArticle2 = $textArticle2;

        return $this;
    }

    /**
     * Get textArticle2
     *
     * @return string
     */
    public function getTextArticle2()
    {
        return $this->textArticle2;
    }

    /**
     * Set textContactme
     *
     * @param string $textContactme
     *
     * @return Homepage
     */
    public function setTextContactme($textContactme)
    {
        $this->textContactme = $textContactme;

        return $this;
    }

    /**
     * Get textContactme
     *
     * @return string
     */
    public function getTextContactme()
    {
        return $this->textContactme;
    }

    /**
     * Set linkImg1
     *
     * @param string $linkImg1
     *
     * @return Homepage
     */
    public function setLinkImg1($linkImg1)
    {
        $this->linkImg1 = $linkImg1;

        return $this;
    }

    /**
     * Get linkImg1
     *
     * @return string
     */
    public function getLinkImg1()
    {
        return $this->linkImg1;
    }

    /**
     * Set linkImg2
     *
     * @param string $linkImg2
     *
     * @return Homepage
     */
    public function setLinkImg2($linkImg2)
    {
        $this->linkImg2 = $linkImg2;

        return $this;
    }

    /**
     * Get linkImg2
     *
     * @return string
     */
    public function getLinkImg2()
    {
        return $this->linkImg2;
    }

    /**
     * Set textLogo
     *
     * @param string $textLogo
     *
     * @return Homepage
     */
    public function setTextLogo($textLogo)
    {
        $this->textLogo = $textLogo;

        return $this;
    }

    /**
     * Get textLogo
     *
     * @return string
     */
    public function getTextLogo()
    {
        return $this->textLogo;
    }

    /**
     * Set img1
     *
     * @param \WP\ExoBundle\Entity\Image $img1
     *
     * @return Homepage
     */
    public function setImg1(\WP\ExoBundle\Entity\Image $img1 = null)
    {
        $this->img1 = $img1;

        return $this;
    }

    /**
     * Get img1
     *
     * @return \WP\ExoBundle\Entity\Image
     */
    public function getImg1()
    {
        return $this->img1;
    }

    /**
     * Set img2
     *
     * @param \WP\ExoBundle\Entity\Image $img2
     *
     * @return Homepage
     */
    public function setImg2(\WP\ExoBundle\Entity\Image $img2 = null)
    {
        $this->img2 = $img2;

        return $this;
    }

    /**
     * Get img2
     *
     * @return \WP\ExoBundle\Entity\Image
     */
    public function getImg2()
    {
        return $this->img2;
    }

    /**
     * Set logo
     *
     * @param \WP\ExoBundle\Entity\Image $logo
     *
     * @return Homepage
     */
    public function setLogo(\WP\ExoBundle\Entity\Image $logo = null)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return \WP\ExoBundle\Entity\Image
     */
    public function getLogo()
    {
        return $this->logo;
    }
}
