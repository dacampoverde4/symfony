<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use AppBundle\Services\GoogleAnalytics;
use AppBundle\Services\GoogleLineChart;

// php bin/console stats:send

class StatsCommand extends ContainerAwareCommand
{
	private $to = array(
		'pbonnet@sasa-demarle.com',
		'cgee@sasa-demarle.com',
		'gdubois@sasa-demarle.com',
		'eguillaume@sasa-demarle.com',
		'sdekhil@sasa-demarle.com',
		'kdhollande@sasa-demarle.com'
	);
	
	protected function configure()
    {
        $this
			->setName('stats:send')
			->setDescription('Send an email with some statistics about the web site. Data come from Google Analytics and the web site\'s database.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();
		$em = $container->get('doctrine')->getManager();

		$analyticsService = new GoogleAnalytics($container->getParameter('google_analytics_json_key'), $container->getParameter('google_analytics_view_id'));

		$weekStart = strtotime('-1 week');
		$weekEnd = strtotime('-1 day');
		$weekStartFormatted = date('Y-m-d', $weekStart);
		$weekEndFormatted = date('Y-m-d', $weekEnd);

		$message = (new \Swift_Message('[Web] Statistiques du '.date('d/m/Y', $weekStart).' au '.date('d/m/Y', $weekEnd)))
			->setFrom($container->getParameter('mailer_sender'))
			->setTo($this->to)
			->setBody($container->get('templating')->render('AppBundle:Emails:stats.html.twig', array(
				'weekStart' => $weekStart,
				'weekEnd' => $weekEnd,
				'visitedPages' => $analyticsService->getVisitedPages($weekStartFormatted, $weekEndFormatted),
				'visitorsLocations' => $analyticsService->getVisitorsLocations($weekStartFormatted, $weekEndFormatted),
				'contactsAmount' => $em->getRepository('ContactUsBundle:Contact')->getContactsAmount($weekStartFormatted, $weekEndFormatted),
				'ordersInformation' => $em->getRepository('ShopBundle:SalesOrder')->getOrdersInformation($weekStartFormatted, $weekEndFormatted),
				'visitedPagesByDate' => $this->visitedPagesByDateUrl($analyticsService->getVisitedPagesByDate($weekStartFormatted, $weekEndFormatted)),
				'visitorsByDate' => $this->visitorsByDateUrl($analyticsService->getVisitorsByDate($weekStartFormatted, $weekEndFormatted))
			)), 'text/html');

		$emailsSent = $container->get('mailer')->send($message);

		$output->writeln($emailsSent.' emails sent');
    }

	private function visitedPagesByDateUrl($source)
	{
		$xLabels = array();
		$values = array();

		foreach($source->getData()->getRows() as $rows)
		{
			$fmt = new \IntlDateFormatter('fr', \IntlDateFormatter::NONE, \IntlDateFormatter::NONE);
			$fmt->setPattern('dd MMM');

			$xLabels[] = $fmt->format(new \DateTime($rows->getDimensions()[0].'-'.$rows->getDimensions()[1].'-'.$rows->getDimensions()[2]));
			$values[] = $rows->getMetrics()[0]->getValues()[0];
		}

		$chart = new GoogleLineChart();
		$chart->setTitle('Pages visitées par jour');
		$chart->setValues(array($values), true);
		$chart->setXLabels($xLabels);
		$chart->setSeriesColor(array('DE0A33'));
		$chart->setLinesThickness(array(3));

		return $chart->getURL();
	}

	private function visitorsByDateUrl($source)
	{
		$xLabels = array();
		$values = array();

		foreach($source->getData()->getRows() as $rows)
		{
			$fmt = new \IntlDateFormatter('fr', \IntlDateFormatter::NONE, \IntlDateFormatter::NONE);
			$fmt->setPattern('dd MMM');

			$xLabels[] = $fmt->format(new \DateTime($rows->getDimensions()[0].'-'.$rows->getDimensions()[1].'-'.$rows->getDimensions()[2]));
			$values[] = $rows->getMetrics()[0]->getValues()[0];
		}

		$chart = new GoogleLineChart();
		$chart->setTitle('Visiteurs uniques par jour');
		$chart->setValues(array($values), true);
		$chart->setXLabels($xLabels);
		$chart->setSeriesColor(array('DE0A33'));
		$chart->setLinesThickness(array(3));

		return $chart->getURL();
	}
}
