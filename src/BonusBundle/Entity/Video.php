<?php

namespace BonusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Intl\Locale;

/**
 * Video
 *
 * @ORM\Table(name="video")
 * @ORM\Entity(repositoryClass="BonusBundle\Repository\VideoRepository")
 */
class Video
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
     * @ORM\Column(name="link", type="string", length=255, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(max="255", maxMessage="bonus.validators.link_length")
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;


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
     * @return Activity
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
     * @return Activity
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
     * Set link
     *
     * @param string $link
     *
     * @return Video
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Video
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
     * __toString
     *
     * @return String
     */
	public function __toString()
	{
		return ((Locale::getDefault() === 'en') ? $this->titleEng : $this->titleFra);
	}
}

