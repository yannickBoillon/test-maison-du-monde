<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
    /**
     * @param int $categoryId
     * @param int $limit
     * @param int $offset
     * @return mixed
     */
    public function findByCategoryId(int $categoryId, $limit = 20, $offset = 0)
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.categories', 'c')
            ->where('c.id = :id')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getQuery()->execute(['id' => $categoryId]);
    }
}
