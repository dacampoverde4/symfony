<?php

namespace ContactUsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Intl\Locale;

/**
 * ProductType
 *
 * @ORM\Table(name="product_type")
 * @ORM\Entity(repositoryClass="ContactUsBundle\Repository\ProductTypeRepository")
 */
class ProductType
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
     * @var bool
     *
     * @ORM\Column(name="show_fra", type="boolean", nullable=false)
	 * @Assert\Type(type="boolean")
     */
    private $showFra;

    /**
     * @var bool
     *
     * @ORM\Column(name="show_eng", type="boolean", nullable=false)
	 * @Assert\Type(type="boolean")
     */
    private $showEng;


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
     * @return ProductType
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
     * @return ProductType
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
     * Set showFra
     *
     * @param boolean $showFra
     *
     * @return ProductType
     */
    public function setShowFra($showFra)
    {
        $this->showFra = $showFra;

        return $this;
    }

    /**
     * Is showFra
     *
     * @return bool
     */
    public function isShowFra()
    {
        return $this->showFra;
    }

    /**
     * Set showEng
     *
     * @param boolean $showEng
     *
     * @return ProductType
     */
    public function setShowEng($showEng)
    {
        $this->showEng = $showEng;

        return $this;
    }

    /**
     * Is showEng
     *
     * @return bool
     */
    public function isShowEng()
    {
        return $this->showEng;
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
