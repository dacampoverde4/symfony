<?php

namespace BonusBundle\Repository;

use \Doctrine\ORM\EntityRepository;
use Symfony\Component\Intl\Locale;

/**
 * TechnicalNoticeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TechnicalNoticeRepository extends EntityRepository
{
	/*
	 * Uses : PublicController::technicalNoticeAction
	 */
	public function getTechnicalNotices()
	{
		$lang = ((Locale::getDefault() === 'en') ? 'Eng' : 'Fra');
		
		$qb = $this->createQueryBuilder('tn')
				   ->leftJoin('tn.category', 'c')
				   ->addSelect('c')
				   ->orderBy('c.title'.$lang, 'asc')
				   ->addOrderBy('tn.title'.$lang, 'asc');

		 return $qb->getQuery()->getResult();
	}
}
