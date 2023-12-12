<?php

namespace ContactUsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Emailing
 *
 * @ORM\Table(name="contact_emailing")
 * @ORM\Entity(repositoryClass="ContactUsBundle\Repository\EmailingRepository")
 */
class Emailing
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
     * @var bool
     *
     * @ORM\Column(name="france", type="boolean", nullable=false)
	 * @Assert\Type(type="boolean")
     */
    private $france;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="ContactUsBundle\Entity\ProductType")
     * @ORM\JoinColumn(nullable=false, name="product_type_id", referencedColumnName="id")
	 * @Assert\NotBlank
     * @Assert\Valid()
     */
    private $productType;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(max="255")
	 * @Assert\Email
     */
    private $email;


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
     * Set france
     *
     * @param boolean $france
     *
     * @return Emailing
     */
    public function setFrance($france)
    {
        $this->france = $france;

        return $this;
    }

    /**
     * Get france
     *
     * @return bool
     */
    public function getFrance()
    {
        return $this->france;
    }

    /**
     * Set productType
     *
     * @param ContactUsBundle\Entity\ProductType $productType
     *
     * @return Emailing
     */
    public function setProductType($productType)
    {
        $this->productType = $productType;

        return $this;
    }

    /**
     * Get productType
     *
     * @return ContactUsBundle\Entity\ProductType
     */
    public function getProductType()
    {
        return $this->productType;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Emailing
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
}
