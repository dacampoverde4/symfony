<?php

namespace BonusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Intl\Locale;

/**
 * TechnicalNoticeCategory
 *
 * @ORM\Table(name="technical_notice_category")
 * @ORM\Entity(repositoryClass="BonusBundle\Repository\TechnicalNoticeCategoryRepository")
 */
class TechnicalNoticeCategory
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titleFra
     *
     * @param string $titleFra
     *
     * @return TechnicalNoticeCategory
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
     * @return TechnicalNoticeCategory
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
     * __toString
     *
     * @return String
     */
	public function __toString()
	{
		return ((Locale::getDefault() === 'en') ? $this->titleEng : $this->titleFra);
	}
}
