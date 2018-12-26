<?php
namespace SlimSkeletonWebAPI\DAO;

use Doctrine\ORM\EntityManager;
use SlimSkeletonWebAPI\Entities\Comment;

class CommentDAO extends BaseDAO
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, Comment::class);
    }
}
