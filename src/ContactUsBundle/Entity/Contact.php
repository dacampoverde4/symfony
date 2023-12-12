<?php

namespace ContactUsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints as Recaptcha;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="ContactUsBundle\Repository\ContactRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Contact
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

     * @ORM\ManyToOne(targetEntity="ContactUsBundle\Entity\Purpose")
     * @ORM\JoinColumn(nullable=false, name="purpose_id", referencedColumnName="id")
	 * @Assert\NotBlank
     * @Assert\Valid()
     */
    private $purpose;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=50, nullable=true)
	 * @Assert\Length(max="50", maxMessage="contact_us.validators.company_length")
     */
    private $company;

    /**
     * @var integer

     * @ORM\ManyToOne(targetEntity="ContactUsBundle\Entity\Activity")
     * @ORM\JoinColumn(nullable=true, name="activity_id", referencedColumnName="id")
     * @Assert\Valid()
     */
    private $activity;

    /**
     * @var integer

     * @ORM\ManyToOne(targetEntity="ContactUsBundle\Entity\Gender")
     * @ORM\JoinColumn(nullable=false, name="gender_id", referencedColumnName="id")
	 * @Assert\NotBlank
     * @Assert\Valid()
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=50, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(max="50", maxMessage="contact_us.validators.last_name_length")
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=50, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(max="50", maxMessage="contact_us.validators.first_name_length")
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(max="255", maxMessage="contact_us.validators.email_length")
	 * @Assert\Email
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(max="20", maxMessage="contact_us.validators.phone_length")
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=200, nullable=true)
	 * @Assert\Length(max="200", maxMessage="contact_us.validators.address_length")
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=50, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(max="50", maxMessage="contact_us.validators.city_length")
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=10, nullable=true)
	 * @Assert\Length(max="10", maxMessage="contact_us.validators.zip_code_length")
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=2, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(max="2", maxMessage="contact_us.validators.country_length")
     */
    private $country;

    /**
     * @var array
	 *
	 * @ORM\ManyToMany(targetEntity="ContactUsBundle\Entity\ProductType", cascade={"persist"})
     */
    private $productTypes;

    /**
     * @var bool
     *
     * @ORM\Column(name="promotions_news", type="boolean", nullable=false)
	 * @Assert\Type(type="boolean", message="contact_us.validators.promotions_news_type")
     */
    private $promotionsNews;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=false)
	 * @Assert\NotBlank
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="file_name_1", type="string", length=50, nullable=true)
	 * @Assert\Length(max="50", maxMessage="contact_us.validators.file_name_1_length")
     */
    private $fileName1;

	/**
     * @var string
	 *
	 * @ORM\Column(name="file_path_1", type="string", length=255, nullable=true)
     * @Assert\File(mimeTypes={"application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "image/jpeg", "image/png"}, maxSize="3M", mimeTypesMessage="contact_us.validators.file_1_type", maxSizeMessage="contact_us.validators.file_1_size")
     */
    private $filePath1;

    /**
     * @var string
     *
     * @ORM\Column(name="file_name_2", type="string", length=50, nullable=true)
	 * @Assert\Length(max="50", maxMessage="contact_us.validators.file_name_2_length")
     */
    private $fileName2;

	/**
     * @var string
	 *
	 * @ORM\Column(name="file_path_2", type="string", length=255, nullable=true)
     * @Assert\File(mimeTypes={"application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "image/jpeg", "image/png"}, maxSize="3M", mimeTypesMessage="contact_us.validators.file_2_type", maxSizeMessage="contact_us.validators.file_2_size")
     */
    private $filePath2;
	
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
    public function __construct()
    {
		$this->productTypes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set purpose
     *
     * @param ContactUsBundle\Entity\Purpose $purpose
     *
     * @return Contact
     */
    public function setPurpose($purpose)
    {
        $this->purpose = $purpose;

        return $this;
    }

    /**
     * Get purpose
     *
     * @return ContactUsBundle\Entity\Purpose
     */
    public function getPurpose()
    {
        return $this->purpose;
    }

    /**
     * Set company
     *
     * @param string $company
     *
     * @return Contact
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
     * Set activity
     *
     * @param ContactUsBundle\Entity\Activity $activity
     *
     * @return Contact
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return ContactUsBundle\Entity\Activity
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Set gender
     *
     * @param ContactUsBundle\Entity\Gender $gender
     *
     * @return Contact
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return ContactUsBundle\Entity\Gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Contact
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
     * @return Contact
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
     * Set email
     *
     * @param string $email
     *
     * @return Contact
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
     * Set phone
     *
     * @param string $phone
     *
     * @return Contact
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
     * Set address
     *
     * @param string $address
     *
     * @return Contact
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
     * Set city
     *
     * @param string $city
     *
     * @return Contact
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
     * Set zipCode
     *
     * @param string $zipCode
     *
     * @return Contact
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
     * Set country
     *
     * @param string $country
     *
     * @return Contact
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
     * Add productType
     *
     * @param \ContactUsBundle\Entity\ProductType $productType
     * @return Contact
     */
    public function addProductType(ProductType $productType)
    {
        $this->productTypes[] = $productType;

        return $this;
    }

    /**
     * Remove productType
     *
     * @param \ContactUsBundle\Entity\ProductType $productType
     */
    public function removeProductType(ProductType $productType)
    {
        $this->productTypes->removeElement($productType);
    }

    /**
     * Get productType
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductTypes()
    {
        return $this->productTypes;
    }

    /**
     * Set promotionsNews
     *
     * @param boolean $promotionsNews
     *
     * @return Contact
     */
    public function setPromotionsNews($promotionsNews)
    {
        $this->promotionsNews = $promotionsNews;

        return $this;
    }

    /**
     * Get promotionsNews
     *
     * @return bool
     */
    public function getPromotionsNews()
    {
        return $this->promotionsNews;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Contact
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set fileName1
     *
     * @param string $fileName1
     *
     * @return Contact
     */
    public function setFileName1($fileName1)
    {
        $this->fileName1 = $fileName1;

        return $this;
    }

    /**
     * Get fileName1
     *
     * @return string
     */
    public function getFileName1()
    {
        return $this->fileName1;
    }

    /**
     * Set filePath1
     *
     * @param string $filePath1
     *
     * @return Contact
     */
    public function setFilePath1($filePath1)
    {
        $this->filePath1 = $filePath1;

        return $this;
    }

    /**
     * Get filePath1
     *
     * @return string
     */
    public function getFilePath1()
    {
        return $this->filePath1;
    }

    /**
     * Set fileName2
     *
     * @param string $fileName2
     *
     * @return Contact
     */
    public function setFileName2($fileName2)
    {
        $this->fileName2 = $fileName2;

        return $this;
    }

    /**
     * Get fileName2
     *
     * @return string
     */
    public function getFileName2()
    {
        return $this->fileName2;
    }

    /**
     * Set filePath2
     *
     * @param string $filePath2
     *
     * @return Contact
     */
    public function setFilePath2($filePath2)
    {
        $this->filePath2 = $filePath2;

        return $this;
    }

    /**
     * Get filePath2
     *
     * @return string
     */
    public function getFilePath2()
    {
        return $this->filePath2;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return Contact
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
		return $this->lastName.' '.$this->firstName;
	}

	/**
	 * @Assert\Callback
	 */
	public function isContentValid(ExecutionContextInterface $context)
	{
		if($this->purpose != null)
		{
			if(in_array($this->purpose->getId(), array(1, 2, 3, 4, 5)) && count($this->productTypes) < 1)
			{
				$context
					->buildViolation('contact_us.validators.product_types_not_blank')
					->atPath('productTypes')
					->addViolation();
			}
		}
	}

	/**
	 * @ORM\PrePersist
	 */
    public function emptyUselessValues()
    {
        if(! $this->purpose->isCompany())
		{
			$this->company = null;
		}

        if(! $this->purpose->isActivity())
		{
			$this->activity = null;
		}

        if(! $this->purpose->isProductTypes())
		{
			$this->productTypes->clear();
		}

        if(! $this->purpose->isFiles())
		{
			$this->fileName1 = null;
			$this->filePath1 = null;
			$this->fileName2 = null;
			$this->filePath2 = null;
		}
    }
}
