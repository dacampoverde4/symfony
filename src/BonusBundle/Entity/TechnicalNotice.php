<?php

namespace BonusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Intl\Locale;

/**
 * TechnicalNotice
 *
 * @ORM\Table(name="technical_notice")
 * @ORM\Entity(repositoryClass="BonusBundle\Repository\TechnicalNoticeRepository")
 */
class TechnicalNotice
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
     * @var integer
     
     * @ORM\ManyToOne(targetEntity="BonusBundle\Entity\TechnicalNoticeCategory")
     * @ORM\JoinColumn(nullable=false, name="category_id", referencedColumnName="id")
     * @Assert\Valid()
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="title_fra", type="string", length=100, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(max="100")
     */
    private $titleFra;

    /**
     * @var string
     *
     * @ORM\Column(name="title_eng", type="string", length=100, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(max="100")
     */
    private $titleEng;

    /**
     * @var string
     *
     * @ORM\Column(name="link_fra", type="string", length=255, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(max="255")
     */
    private $linkFra;

    /**
     * @var string
     *
     * @ORM\Column(name="link_eng", type="string", length=255, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(max="255")
     */
    private $linkEng;


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
     * Set category
     *
     * @param BonusBundle\Entity\TechnicalNoticeCategory $category
     * @return TechnicalNotice
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return BonusBundle\Entity\TechnicalNoticeCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set titleFra
     *
     * @param string $titleFra
     *
     * @return TechnicalNotice
     */
    public function setTitleFra($titleFra)
    {
        $this->titleFra = $titleFra;

        return $this;
    }

    /**
     * Get titleFra
     *
     * @return string
     */
    public function getTitleFra()
    {
        return $this->titleFra;
    }

    /**
     * Set titleEng
     *
     * @param string $titleEng
     *
     * @return TechnicalNotice
     */
    public function setTitleEng($titleEng)
    {
        $this->titleEng = $titleEng;

        return $this;
    }

    /**
     * Get titleEng
     *
     * @return string
     */
    public function getTitleEng()
    {
        return $this->titleEng;
    }

    /**
     * Set linkFra
     *
     * @param string $linkFra
     *
     * @return TechnicalNotice
     */
    public function setLinkFra($linkFra)
    {
        $this->linkFra = $linkFra;

        return $this;
    }

    /**
     * Get linkFra
     *
     * @return string
     */
    public function getLinkFra()
    {
        return $this->linkFra;
    }

    /**
     * Set linkEng
     *
     * @param string $linkEng
     *
     * @return TechnicalNotice
     */
    public function setLinkEng($linkEng)
    {
        $this->linkEng = $linkEng;

        return $this;
    }

    /**
     * Get linkEng
     *
     * @return string
     */
    public function getLinkEng()
    {
        return $this->linkEng;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return ((Locale::getDefault() === 'en') ? $this->linkEng : $this->linkFra);
    }

	/**
     * __toString
     *
     * @return String
     */
	public function __toString()
	{
		return ((Locale::getDefault() === 'en') ? $this->titleEng : $this->titleFra);
	}
}
