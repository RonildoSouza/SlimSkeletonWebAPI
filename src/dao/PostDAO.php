<?php
namespace SlimSkeletonWebAPI\DAO;

use Doctrine\ORM\EntityManager;
use SlimSkeletonWebAPI\Entities\Post;

class PostDAO extends BaseDAO
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, Post::class);
    }
}
