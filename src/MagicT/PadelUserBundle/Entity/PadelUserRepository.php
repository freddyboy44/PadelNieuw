<?php

namespace MagicT\PadelUserBundle\Entity;

use MagicT\PadelUserBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PadelUserRepository extends EntityRepository
{
	public function findAllActieveLeden() {
		$qb = $this->getEntityManager()->createQueryBuilder();
		$query = $qb->select('u')
            ->from('PadelUserBundle:PadelUser', 'u')
            ->where('u.lidtot >= :vandaag')
            ->setParameter('vandaag',date('Y-m-d'))
            ->getQuery()
            ->getResult();
        return $query;
	}

	public function findOneRandom() {


        $qb = $this->getEntityManager()->createQueryBuilder();

        $count = $this->createQueryBuilder('u')
             ->select('COUNT(u)')
             ->where('u.lidtot >= :vandaag')
             ->setParameter('vandaag',date('Y-m-d'))
             ->getQuery()
             ->getSingleScalarResult();
             

        $query = $this->createQueryBuilder('u')
            ->setFirstResult(rand(0, $count - 1))
            ->setMaxResults(1)
            ->where('u.lidtot >= :vandaag')
            ->setParameter('vandaag',date('Y-m-d'))
            ->getQuery()
            ->getOneOrNullResult();
            
        return $query;
    }
}