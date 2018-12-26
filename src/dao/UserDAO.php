<?php
namespace SlimSkeletonWebAPI\DAO;

use Doctrine\ORM\EntityManager;
use SlimSkeletonWebAPI\Entities\User;

class UserDAO extends BaseDAO
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, User::class);
    }
}
