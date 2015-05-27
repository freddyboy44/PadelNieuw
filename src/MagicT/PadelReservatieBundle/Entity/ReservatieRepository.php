<?php

namespace MagicT\PadelReservatieBundle\Entity;
use MagicT\PadelReservatieBundle\Entity\Reservatie;
use Doctrine\ORM\EntityRepository;

/**
 * ReservatieRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReservatieRepository extends EntityRepository
{
	public function findVoorDag($datum) {
		$qb = $this->getEntityManager()->createQueryBuilder();
		$query = $qb->select('r')
            ->from('PadelReservatieBundle:Reservatie', 'r')
            ->where('r.datum = :datum')
		  	->setParameter('datum', date_format($datum,'Y-m-d'))
            ->getQuery()
            ->getResult();
        return $query;
	}

	public function findVoorVeld($veldid) {
		
		$veld = $this->getEntityManager()->getRepository('PadelReservatieBundle:Veld')->find($veldid);

		$qb = $this->getEntityManager()->createQueryBuilder();
		$query = $qb->select('r')
            ->from('PadelReservatieBundle:Reservatie', 'r')
            ->where('r.veld = :veld')
		  	->setParameter('veld', $veld)
            ->getQuery()
            ->getResult();
        return $query;
	}

	public function findVoorVeldDag($veldid,$datum) {
		
		$veld = $this->getEntityManager()->getRepository('PadelReservatieBundle:Veld')->find($veldid);

		$qb = $this->getEntityManager()->createQueryBuilder();
		$query = $qb->select('r')
            ->from('PadelReservatieBundle:Reservatie', 'r')
            ->where('r.veld = :veld')
            ->andwhere('r.datum = :datum')
		  	->setParameter('datum', date_format($datum,'Y-m-d'))
		  	->setParameter('veld', $veld)
            ->getQuery()
            ->getResult();
        return $query;
	}
}