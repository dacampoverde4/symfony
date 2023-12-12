<?php

namespace ContactUsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Intl\Locale;

/**
 * Purpose
 *
 * @ORM\Table(name="purpose")
 * @ORM\Entity(repositoryClass="ContactUsBundle\Repository\PurposeRepository")
 */
class Purpose
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
     * @var string
     *
     * @ORM\Column(name="email_subject_fra", type="string", length=100, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(max="100")
     */
    private $emailSubjectFra;

    /**
     * @var string
     *
     * @ORM\Column(name="email_subject_eng", type="string", length=100, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(max="100")
     */
    private $emailSubjectEng;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
	 * @Assert\Length(max="255")
	 * @Assert\Email
     */
    private $email;

    /**
     * @var bool
     *
     * @ORM\Column(name="company", type="boolean", nullable=false)
	 * @Assert\Type(type="boolean")
     */
    private $company;

    /**
     * @var bool
     *
     * @ORM\Column(name="activity", type="boolean", nullable=false)
	 * @Assert\Type(type="boolean")
     */
    private $activity;

    /**
     * @var bool
     *
     * @ORM\Column(name="product_types", type="boolean", nullable=false)
	 * @Assert\Type(type="boolean")
     */
    private $productTypes;

    /**
     * @var bool
     *
     * @ORM\Column(name="files", type="boolean", nullable=false)
	 * @Assert\Type(type="boolean")
     */
    private $files;


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
     * @return Purpose
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
     * @return Purpose
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
     * Set emailSubjectFra
     *
     * @param string $emailSubjectFra
     *
     * @return Purpose
     */
    public function setEmailSubjectFra($emailSubjectFra)
    {
        $this->emailSubjectFra = $emailSubjectFra;

        return $this;
    }

    /**
     * Get emailSubjectFra
     *
     * @return string
     */
    public function getEmailSubjectFra()
    {
        return $this->emailSubjectFra;
    }

    /**
     * Set emailSubjectEng
     *
     * @param string $emailSubjectEng
     *
     * @return Purpose
     */
    public function setEmailSubjectEng($emailSubjectEng)
    {
        $this->emailSubjectEng = $emailSubjectEng;

        return $this;
    }

    /**
     * Get emailSubjectEng
     *
     * @return string
     */
    public function getEmailSubjectEng()
    {
        return $this->emailSubjectEng;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Purpose
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
     * Set company
     *
     * @param boolean $company
     *
     * @return Purpose
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Is company
     *
     * @return bool
     */
    public function isCompany()
    {
        return $this->company;
    }

    /**
     * Set activity
     *
     * @param boolean $activity
     *
     * @return Purpose
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Is activity
     *
     * @return bool
     */
    public function isActivity()
    {
        return $this->activity;
    }

    /**
     * Set productTypes
     *
     * @param boolean $productTypes
     *
     * @return Purpose
     */
    public function setProductTypes($productTypes)
    {
        $this->productTypes = $productTypes;

        return $this;
    }

    /**
     * Is productTypes
     *
     * @return bool
     */
    public function isProductTypes()
    {
        return $this->productTypes;
    }

    /**
     * Set files
     *
     * @param boolean $files
     *
     * @return Purpose
     */
    public function setFiles($files)
    {
        $this->files = $files;

        return $this;
    }

    /**
     * Is files
     *
     * @return bool
     */
    public function isFiles()
    {
        return $this->files;
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

	/**
     * Get emailSubject
     *
     * @return String
     */
	public function getEmailSubject()
	{
		return ((Locale::getDefault() === 'en') ? $this->emailSubjectEng : $this->emailSubjectFra);
	}
}
