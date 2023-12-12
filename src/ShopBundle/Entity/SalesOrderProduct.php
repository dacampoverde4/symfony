<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * SalesOrderProduct
 *
 * @ORM\Table(name="sales_order_product")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\SalesOrderProductRepository")
 */
class SalesOrderProduct
{
	/**
     * @ORM\Id
	 * @ORM\ManyToOne(targetEntity="ShopBundle\Entity\SalesOrder", inversedBy="salesOrderProducts")
	 * @ORM\JoinColumn(nullable=false, name="sales_order_id", referencedColumnName="id")
     * @Assert\Valid()
	 */
	private $salesOrder;

	/**
     * @ORM\Id
	 * @ORM\ManyToOne(targetEntity="ShopBundle\Entity\Product")
	 * @ORM\JoinColumn(nullable=false, name="product_id", referencedColumnName="id")
     * @Assert\Valid()
	 */
	private $product;

	/**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer", nullable=false)
	 * @Assert\Type(type="integer", message="shop.validators.quantity_type")
     */
    private $quantity;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", nullable=false)
	 * @Assert\Type(type="float", message="shop.validators.price_type")
	 * @Assert\GreaterThan(value=0, message="shop.validators.price_greater_than")
     */
    private $price;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->quantity = 0;
    }

    /**
     * Set salesOrder
     *
     * @param ShopBundle\Entity\SalesOrder $salesOrder
     *
     * @return SalesOrderProduct
     */
    public function setSalesOrder($salesOrder)
    {
        $this->salesOrder = $salesOrder;

        return $this;
    }

    /**
     * Get salesOrder
     *
     * @return ShopBundle\Entity\SalesOrder
     */
    public function getSalesOrder()
    {
        return $this->salesOrder;
    }

    /**
     * Set product
     *
     * @param ShopBundle\Entity\Product $product
     *
     * @return SalesOrderProduct
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return ShopBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

	/**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return SalesOrderProduct
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return SalesOrderProduct
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
     * __toString
     *
     * @return String
     */
	public function __toString()
	{
		return $this->product->getId();
	}

	/**
	 * @Assert\Callback
	 */
	public function isContentValid(ExecutionContextInterface $context)
	{
		if($this->quantity % $this->getProduct()->getUnit() != 0)
		{
			$context
				->buildViolation('shop.validators.quantity_step')
				->atPath('quantity')
				->addViolation();
		}
	}
}
