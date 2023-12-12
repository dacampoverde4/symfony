<?php

namespace ShopBundle\Form\Handler;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

use ShopBundle\Entity\SalesOrder;

class SalesOrderHandler
{
    protected $form;
    protected $request;
    protected $em;

    public function __construct(Form $form, Request $request, EntityManager $em)
	{
        $this->form = $form;
        $this->request = $request;
        $this->em = $em;
    }

    public function process()
	{
        if($this->request->isMethod('POST'))
		{
			$this->form->handleRequest($this->request);

            if($this->form->isSubmitted() && $this->form->isValid())
			{
                $this->onSuccess($this->form->getData());

                return true;
            }
        }

        return false;
    }

    public function onSuccess(SalesOrder $salesOrder)
	{
		foreach($salesOrder->getSalesOrderProducts() as $salesOrderProduct)
		{
			if($salesOrderProduct->getQuantity() < 1)
			{
				$salesOrder->removeSalesOrderProduct($salesOrderProduct);
			}
			else
			{
				$salesOrderProduct->setPrice($salesOrderProduct->getProduct()->getPrice());
			}
		}

		$this->em->persist($salesOrder);
        $this->em->flush();
    }
}
