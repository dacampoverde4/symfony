<?php

namespace ShopBundle\Repository;

use \Doctrine\ORM\EntityRepository;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends EntityRepository
{
	/*
	 * Uses : PublicController::indexAction
	 */
	public function getProducts()
	{
		$qb = $this->createQueryBuilder('p')
				   ->leftJoin('p.category', 'c')
				   ->where('p.enable = :enable')->setParameter('enable', true)
				   ->orderBy('c.order', 'asc')
				   ->addOrderBy('p.id', 'asc');

		return $qb->getQuery()->getResult();
	}
}