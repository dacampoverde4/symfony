<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Intl\Locale;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\ProductRepository")
 * @UniqueEntity(fields="id", message="shop.validators.product_id_uniq")
 */
class Product
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=20)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
	 * @Assert\Length(max="20", maxMessage="shop.validators.product_id_length")
     */
    private $id;

    /**
     * @var integer

     * @ORM\ManyToOne(targetEntity="ShopBundle\Entity\ProductCategory")
     * @ORM\JoinColumn(nullable=false, name="category_id", referencedColumnName="id")
	 * @Assert\NotBlank
     * @Assert\Valid()
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="description_1_fra", type="string", length=50, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(max="50", maxMessage="shop.validators.description_1_fra_length")
     */
    private $description1Fra;

    /**
     * @var string
     *
     * @ORM\Column(name="description_1_eng", type="string", length=50, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(max="50", maxMessage="shop.validators.description_1_eng_length")
     */
    private $description1Eng;

    /**
     * @var string
     *
     * @ORM\Column(name="description_2_fra", type="string", length=50, nullable=true)
	 * @Assert\Length(max="50", maxMessage="shop.validators.description_2_fra_length")
     */
    private $description2Fra;

    /**
     * @var string
     *
     * @ORM\Column(name="description_2_eng", type="string", length=50, nullable=true)
	 * @Assert\Length(max="50", maxMessage="shop.validators.description_2_eng_length")
     */
    private $description2Eng;

    /**
     * @var string
     *
     * @ORM\Column(name="description_3_fra", type="string", length=50, nullable=true)
	 * @Assert\Length(max="50", maxMessage="shop.validators.description_3_fra_length")
     */
    private $description3Fra;

    /**
     * @var string
     *
     * @ORM\Column(name="description_3_eng", type="string", length=50, nullable=true)
	 * @Assert\Length(max="50", maxMessage="shop.validators.description_3_eng_length")
     */
    private $description3Eng;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", nullable=false)
	 * @Assert\Type(type="float", message="shop.validators.price_type")
	 * @Assert\GreaterThan(value=0, message="shop.validators.price_greater_than")
     */
    private $price;

    /**
     * @var int
     *
     * @ORM\Column(name="unit", type="integer", nullable=false)
	 * @Assert\Type(type="integer", message="shop.validators.unit_type")
	 * @Assert\GreaterThan(value=0, message="shop.validators.unit_greater_than")
     */
    private $unit;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var bool
     *
     * @ORM\Column(name="demarle", type="boolean", nullable=false)
	 * @Assert\Type(type="boolean")
     */
    private $demarle;

    /**
     * @var bool
     *
     * @ORM\Column(name="enable", type="boolean", nullable=false)
	 * @Assert\Type(type="boolean")
     */
    private $enable;


    /**
     * Set id
     *
     * @param string $id
     *
     * @return Product
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set category
     *
     * @param ShopBundle\Entity\ProductCategory $category
     *
     * @return Product
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return ShopBundle\Entity\ProductCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set description1Fra
     *
     * @param string $description1Fra
     *
     * @return Product
     */
    public function setDescription1Fra($description1Fra)
    {
        $this->description1Fra = $description1Fra;

        return $this;
    }

    /**
     * Get description1Fra
     *
     * @return string
     */
    public function getDescription1Fra()
    {
        return $this->description1Fra;
    }

    /**
     * Set description1Eng
     *
     * @param string $description1Eng
     *
     * @return Product
     */
    public function setDescription1Eng($description1Eng)
    {
        $this->description1Eng = $description1Eng;

        return $this;
    }

    /**
     * Get description1Eng
     *
     * @return string
     */
    public function getDescription1Eng()
    {
        return $this->description1Eng;
    }

    /**
     * Set description2Fra
     *
     * @param string $description2Fra
     *
     * @return Product
     */
    public function setDescription2Fra($description2Fra)
    {
        $this->description2Fra = $description2Fra;

        return $this;
    }

    /**
     * Get description2Fra
     *
     * @return string
     */
    public function getDescription2Fra()
    {
        return $this->description2Fra;
    }

    /**
     * Set description2Eng
     *
     * @param string $description2Eng
     *
     * @return Product
     */
    public function setDescription2Eng($description2Eng)
    {
        $this->description2Eng = $description2Eng;

        return $this;
    }

    /**
     * Get description2Eng
     *
     * @return string
     */
    public function getDescription2Eng()
    {
        return $this->description2Eng;
    }

    /**
     * Set description3Fra
     *
     * @param string $description3Fra
     *
     * @return Product
     */
    public function setDescription3Fra($description3Fra)
    {
        $this->description3Fra = $description3Fra;

        return $this;
    }

    /**
     * Get description3Fra
     *
     * @return string
     */
    public function getDescription3Fra()
    {
        return $this->description3Fra;
    }

    /**
     * Set description3Eng
     *
     * @param string $description3Eng
     *
     * @return Product
     */
    public function setDescription3Eng($description3Eng)
    {
        $this->description3Eng = $description3Eng;

        return $this;
    }

    /**
     * Get description3Eng
     *
     * @return string
     */
    public function getDescription3Eng()
    {
        return $this->description3Eng;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set unit
     *
     * @param integer $unit
     *
     * @return Product
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return int
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Product
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set demarle
     *
     * @param boolean $demarle
     *
     * @return Product
     */
    public function setDemarle($demarle)
    {
        $this->demarle = $demarle;

        return $this;
    }

    /**
     * Is demarle
     *
     * @return bool
     */
    public function isDemarle()
    {
        return $this->demarle;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     *
     * @return Product
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * Is enable
     *
     * @return bool
     */
    public function isEnable()
    {
        return $this->enable;
    }

	/**
     * __toString
     *
     * @return String
     */
	public function __toString()
	{
		return $this->id.' ('.((Locale::getDefault() === 'en') ? $this->description1Eng : $this->description1Fra).')';
	}

    /**
     * Get description1
     *
     * @return string
     */
    public function getDescription1()
    {
        return ((Locale::getDefault() === 'en') ? $this->description1Eng : $this->description1Fra);
    }

    /**
     * Get description2
     *
     * @return string
     */
    public function getDescription2()
    {
        return ((Locale::getDefault() === 'en') ? $this->description2Eng : $this->description2Fra);
    }

    /**
     * Get description3
     *
     * @return string
     */
    public function getDescription3()
    {
        return ((Locale::getDefault() === 'en') ? $this->description3Eng : $this->description3Fra);
    }
}
