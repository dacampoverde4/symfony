<?php

namespace AppBundle\Twig;

class CountryExtension extends \Twig_Extension
{
	public function getFilters()
	{
		return array(
			new \Twig_SimpleFilter('countryName', array($this, 'countryFilter'))
		);
	}

	public function countryFilter($countryCode)
	{
		return \Symfony\Component\Intl\Intl::getRegionBundle()->getCountryName($countryCode);
	}

	public function getName()
	{
		return 'country_extension';
	}
}
