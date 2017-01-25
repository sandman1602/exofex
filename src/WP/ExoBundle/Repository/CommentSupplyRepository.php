<?php

namespace WP\ExoBundle\Repository;
use Doctrine\ORM\Tools\Pagination\Paginator;
/**
 * CommentSupplyRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentSupplyRepository extends \Doctrine\ORM\EntityRepository
{

    public function getPageCommentBySupply($supplyId, $page, $nbPerPage) {
        $query = $this->createQueryBuilder('cs')
            ->leftJoin('cs.user', 'u')
            ->addSelect('u')
            ->leftJoin('cs.supply', 's')
            ->addSelect('s')
            ->where('s.id = '.$supplyId)
            ->orderBy('cs.id','desc')
            ->getQuery();

        $query->setFirstResult(($page-1) * $nbPerPage)->setMaxResults($nbPerPage);

        return new Paginator($query, true);
    }
}
