<?php

namespace WP\ExoBundle\Repository;

use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * AskingRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AskingRepository extends \Doctrine\ORM\EntityRepository
{
    public function getPageAsking($page, $nbPerPage) {
        $query = $this->createQueryBuilder('a')
            ->leftJoin('a.user','u')
            ->addSelect('u')
            ->orderBy('a.id','desc')
            ->getQuery();

        $query->setFirstResult(($page-1) * $nbPerPage)->setMaxResults($nbPerPage);

        return new Paginator($query, true);
    }

    public function getSearchAsking($search, $tolerance = 3) {
        $query = $this->createQueryBuilder('a')
            ->leftJoin('a.user','u')
            ->addSelect('u')
            ->where('LEVENSHTEIN(a.title, :search) <= :tolerance')
            ->orWhere('a.title LIKE :searchLike')
            ->orderBy('a.id','desc')
            ->setParameter('search', $search)
            ->setParameter('searchLike','%'.$search.'%')
            ->setParameter('tolerance', $tolerance);
        return $query
            ->getQuery()
            ->getResult();
    }
}
