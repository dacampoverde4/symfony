<?php

namespace BonusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PublicController extends Controller
{
    public function videoAction()
    {
		$result = $this->getDoctrine()->getManager()->getRepository('BonusBundle:Video')->findAll();
		
        return $this->render('BonusBundle:Public:video.html.twig', array(
			'videos' => $result
		));
    }
	
    public function eventAction()
    {
		$result = $this->getDoctrine()->getManager()->getRepository('BonusBundle:Event')->getOpenedEvents();
		
        return $this->render('BonusBundle:Public:event.html.twig', array(
			'events' => $result
		));
    }
	
    public function technicalNoticeAction()
    {
		$result = $this->getDoctrine()->getManager()->getRepository('BonusBundle:TechnicalNotice')->getTechnicalNotices();
		
        return $this->render('BonusBundle:Public:technical_notice.html.twig', array(
			'technicalNotices' => $result
		));
    }
}
