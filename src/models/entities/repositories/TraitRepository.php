<?php
namespace SlimSkeletonWebAPI\Entities\Repositories;

trait TraitRepository
{
    protected function getAll($dql, $entityManager)
    {        
        $query = $entityManager->createQuery($dql);
        return $query->getResult();;
    }

    protected function getById($dql, $entityManager, $id)
    {        
        $query = $entityManager->createQuery($dql)
                               ->setParameter(1, $id);
        return current($query->getResult());
    }
}
