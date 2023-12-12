<?php

namespace AppBundle\Twig;

class IntlExtension extends \Twig_Extension
{
	public function getFilters()
	{
		return array(
			new \Twig_SimpleFilter('intl_number', array($this, 'intlNumber')),
			new \Twig_SimpleFilter('intl_date', array($this, 'intlDate'))
		);
	}

	public function intlNumber($number, $locale = null)
    {
        $fmt = new \NumberFormatter($locale, \NumberFormatter::DECIMAL);
		
        return $fmt->format($number);
    }

	public function intlDate($date, $format, $locale = null)
    {
        $fmt = new \IntlDateFormatter($locale, \IntlDateFormatter::NONE, \IntlDateFormatter::NONE);
		$fmt->setPattern($format);
		
        return $fmt->format($date);
    }

	public function getName()
	{
		return 'intl_extension';
	}
}
