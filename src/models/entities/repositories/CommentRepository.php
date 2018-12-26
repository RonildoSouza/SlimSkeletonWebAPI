<?php
namespace SlimSkeletonWebAPI\Entities\Repositories;

use Doctrine\ORM\EntityRepository;

final class CommentRepository extends EntityRepository
{
    use TraitRepository;
    
    public function getComments()
    {
        $dql = "SELECT c, u, p FROM " . ENTITY_NAMESPACE . "Comment c LEFT JOIN c.user u LEFT JOIN c.post p ORDER BY c.id";
        return $this->getAll($dql, $this->getEntityManager());
    }

    public function getCommentById($id)
    {
        $dql = "SELECT c, u, p FROM " . ENTITY_NAMESPACE . "Comment c LEFT JOIN c.user u LEFT JOIN c.post p WHERE c.id = ?1";
        return $this->getById($dql, $this->getEntityManager(), $id);
    }
}
