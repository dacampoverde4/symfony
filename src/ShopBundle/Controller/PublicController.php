<?php

namespace ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use ShopBundle\Entity\SalesOrder;
use ShopBundle\Form\Type\SalesOrderType;
use ShopBundle\Form\Handler\SalesOrderHandler;

class PublicController extends Controller
{
    public function indexAction(Request $request)
    {
		$em = $this->getDoctrine()->getManager();

		$productList = $em->getRepository('ShopBundle:Product')->getProducts();
		$salesOrder = new SalesOrder($productList);
		$form = $this->createForm(SalesOrderType::class, $salesOrder);
        $formHandler = new SalesOrderHandler($form, $request, $em);

        if($formHandler->process())
		{
			$sendTo = array();
			$sasa = false;
			$demarle = false;

			foreach($salesOrder->getSalesOrderProducts() as $salesOrderProduct)
			{
				if($salesOrderProduct->getProduct()->isDemarle())
				{
					$demarle = true;
				}
				else
				{
					$sasa = true;
				}
			}

			$result = $em->getRepository('ShopBundle:Emailing')->findBy(array('france' => ($salesOrder->getCountry() == 'FR'), 'sasa' => $sasa, 'demarle' => $demarle));

			foreach($result as $emailing)
			{
				$sendTo[] = $emailing->getEmail();
			}

			$translator = $this->get('translator');
			$mailer = $this->get('mailer');

			$messageGsd = (new \Swift_Message('[Web] '.$translator->trans('shop.email.subject_gsd')))
				->setFrom($this->getParameter('mailer_sender'))
				->setTo($sendTo)
				->setBcc($this->getParameter('mailer_admin'))
				->setBody($this->renderView('ShopBundle:Emails:info_gsd.html.twig', array(
					'order' => $salesOrder
				)), 'text/html');

			$mailer->send($messageGsd);

			$messageCustomer = (new \Swift_Message($translator->trans('shop.email.subject_customer')))
				->setFrom($this->getParameter('mailer_sender'))
				->setTo($salesOrder->getEmail())
				->setBcc($this->getParameter('mailer_admin'))
				->setBody($this->renderView('ShopBundle:Emails:info_customer.html.twig', array(
					'order' => $salesOrder
				)), 'text/html');

			$mailer->send($messageCustomer);

			$this->get('session')->getFlashBag()->add('success', 'shop.flash.add_sales_order_success');

			return $this->redirect($this->generateUrl('shop_homepage'));
        }

		if($form->getErrors(true)->count() > 0)
		{
			$this->get('session')->getFlashBag()->add('danger', 'shop.flash.errors_in_form');
		}

        return $this->render('ShopBundle:Public:index.html.twig', array(
            'form' => $form->createView(),
			'decimales' => (new \NumberFormatter('fr', \NumberFormatter::DECIMAL))->getAttribute(\NumberFormatter::FRACTION_DIGITS)
        ));
    }
}
