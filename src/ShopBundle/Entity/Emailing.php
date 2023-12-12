<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Emailing
 *
 * @ORM\Table(name="sales_order_emailing")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\EmailingRepository")
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
     * @var bool
     *
     * @ORM\Column(name="sasa", type="boolean", nullable=false)
	 * @Assert\Type(type="boolean")
     */
    private $sasa;

    /**
     * @var bool
     *
     * @ORM\Column(name="demarle", type="boolean", nullable=false)
	 * @Assert\Type(type="boolean")
     */
    private $demarle;

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
     * Is france
     *
     * @return bool
     */
    public function isFrance()
    {
        return $this->france;
    }

    /**
     * Set sasa
     *
     * @param boolean $sasa
     *
     * @return Emailing
     */
    public function setSasa($sasa)
    {
        $this->sasa = $sasa;

        return $this;
    }

    /**
     * Is sasa
     *
     * @return bool
     */
    public function isSasa()
    {
        return $this->sasa;
    }

    /**
     * Set demarle
     *
     * @param boolean $demarle
     *
     * @return Emailing
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

