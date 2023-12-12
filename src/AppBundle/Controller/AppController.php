<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    public function indexAction()
    {
		return $this->render('AppBundle:App:index.html.twig');
    }

    public function termsOfSalesSasaAction()
    {
        return $this->render('AppBundle:App:tos_sasa.html.twig');
    }

    public function termsOfSalesDemarleAction()
    {
        return $this->render('AppBundle:App:tos_demarle.html.twig');
    }

    public function photosCatalogAction()
    {
		return $this->render('AppBundle:App:photos_catalog.html.twig');
    }

    public function privacyAction()
    {
        return $this->render('AppBundle:App:privacy.html.twig');
    }
}
