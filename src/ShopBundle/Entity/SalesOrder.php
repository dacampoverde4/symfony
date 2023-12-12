<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints as Recaptcha;

/**
 * SalesOrder
 *
 * @ORM\Table(name="sales_order")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\SalesOrderRepository")
 */
class SalesOrder
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
     * @ORM\Column(name="company", type="string", length=50, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(max="50", maxMessage="shop.validators.company_length")
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=50, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(max="50", maxMessage="shop.validators.last_name_length")
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=50, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(max="50", maxMessage="shop.validators.first_name_length")
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=200, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(max="200", maxMessage="shop.validators.address_length")
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="zipCode", type="string", length=10, nullable=true)
	 * @Assert\Length(max="10", maxMessage="shop.validators.zip_code_length")
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=50, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(max="50", maxMessage="shop.validators.city_length")
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=2, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(max="2", maxMessage="shop.validators.country_length")
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="crn", type="string", length=20, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(max="20", maxMessage="shop.validators.crn_length")
     */
    private $crn;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(max="20", maxMessage="shop.validators.phone_length")
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(max="255", maxMessage="shop.validators.email_length")
	 * @Assert\Email
     */
    private $email;

	/**
     * @ORM\OneToMany(targetEntity="ShopBundle\Entity\SalesOrderProduct", mappedBy="salesOrder", cascade={"persist"})
     * @Assert\Valid()
     */
    private $salesOrderProducts;
	
	/**
	 * @Recaptcha\IsTrue
	 */
	public $recaptcha;

    /**
     * @var \DateTime $creationDate
     *
	 * @ORM\Column(name="creation_date", type="datetime", nullable=false)
     * @Assert\DateTime()
     */
    private $creationDate;


    /**
     * Constructor
     */
    public function __construct($productList)
    {
        $this->salesOrderProducts = new \Doctrine\Common\Collections\ArrayCollection();

		foreach($productList as $product)
		{
			$temp = new SalesOrderProduct();
			$temp->setSalesOrder($this);
			$temp->setProduct($product);

			$this->salesOrderProducts[] = $temp;
		}

        $this->creationDate = new \Datetime('now');
    }

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
     * Set company
     *
     * @param string $company
     *
     * @return SalesOrder
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return SalesOrder
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return SalesOrder
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return SalesOrder
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     *
     * @return SalesOrder
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return SalesOrder
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return SalesOrder
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set crn
     *
     * @param string $crn
     *
     * @return SalesOrder
     */
    public function setCrn($crn)
    {
        $this->crn = $crn;

        return $this;
    }

    /**
     * Get crn
     *
     * @return string
     */
    public function getCrn()
    {
        return $this->crn;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return SalesOrder
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return SalesOrder
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Add salesOrderProduct
     *
     * @param \ShopBundle\Entity\SalesOrderProduct $salesOrderProduct
     * @return Product
     */
    public function addSalesOrderProduct(SalesOrderProduct $salesOrderProduct)
    {
        $this->salesOrderProducts[] = $salesOrderProduct;

        return $this;
    }

    /**
     * Remove salesOrderProduct
     *
     * @param \ShopBundle\Entity\SalesOrderProduct $salesOrderProduct
     */
    public function removeSalesOrderProduct(SalesOrderProduct $salesOrderProduct)
    {
        $this->salesOrderProducts->removeElement($salesOrderProduct);
    }

    /**
     * Get salesOrderProducts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSalesOrderProducts()
    {
        return $this->salesOrderProducts;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return SalesOrder
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

	/**
     * __toString
     *
     * @return String
     */
	public function __toString()
	{
		return $this->company;
	}

	/**
	 * @Assert\Callback
	 */
	public function isContentValid(ExecutionContextInterface $context)
	{
		$total = 0;

		foreach($this->salesOrderProducts as $salesOrderProduct)
		{
			$total += $salesOrderProduct->getQuantity();
		}

		if($total < 1)
		{
			$context
				->buildViolation('shop.validators.product_selection_not_blank')
				->addViolation();
		}
	}
}
