<?php

namespace AppBundle\Twig;

class TimeExtension extends \Twig_Extension
{
	public function getFilters()
	{
		return array(
			new \Twig_SimpleFilter('stringToTime', array($this, 'stringToTimeFilter'))
		);
	}

	public function stringToTimeFilter($secondsInStr)
	{
		return gmdate('H:i:s', intval($secondsInStr));
	}

	public function getName()
	{
		return 'time_extension';
	}
}
