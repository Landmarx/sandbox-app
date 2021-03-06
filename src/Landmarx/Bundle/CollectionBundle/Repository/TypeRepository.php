<?php
namespace Landmarx\Bundle\CollectionBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

class TypeRepository extends DocumentRepository
{
    public function findAllOrderedByLastname()
    {
        return $this->createQueryBuilder()
            ->sort('name', 'ASC')
            ->getQuery()
            ->execute();
    }

    public function findBySlug($slug)
    {
        return $this->createQueryBuilder()
            ->field('slug')
            ->equals($slug)
            ->getQuery()
            ->execute();
    }
}
