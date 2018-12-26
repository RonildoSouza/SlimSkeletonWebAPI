<?php
namespace SlimSkeletonWebAPI\DAO;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use SlimSkeletonWebAPI\Entities\BaseEntity;

abstract class BaseDAO
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $_entityManager = null;
     /**
     * @var \Doctrine\ORM\EntityRepository
     */
    private $_entityRepository = null;
     /**
     * @var string
     */
    private $_entityClass = null;

    public function __construct(EntityManager $entityManager, $entityClass)
    {
        if (!isset($entityClass)) {
            throw new \Exception('The parameter $entityClass not set!');
        }

        $this->_entityManager = $entityManager;
        $this->_entityClass = $entityClass;
    }

    /**
     * Get entity class name
     * 
     * @return string
     */
    public function getEntityClass()
    {
        if (!isset($this->_entityClass)) {
            throw new \Exception('The EntityClass not set!');
        }

        return $this->_entityClass;
    }

    /**
     * Get instance of entity manager
     * 
     * @return Doctrine\ORM\EntityManager
     */
    public function getEntityManagerInstance()
    {
        if (!isset($this->_entityManager)) {
            throw new \Exception('The EntityManager not set!');
        }

        return $this->_entityManager;
    }

    /**
     * Get singleton instance entity repository
     * 
     * @return Doctrine\ORM\EntityRepository
     */
    public function getEntityRepositoryInstance()
    {
        if ($this->_entityRepository === null) {
            $this->_entityRepository = $this->getEntityManagerInstance()->getRepository($this->getEntityClass());
        }

        return $this->_entityRepository;
    }

    /**
     * Return all records.
     *
     * @return array of entities
     */
    public function getAll()
    {
        $entities = $this->getEntityRepositoryInstance()->findAll();
        return $entities;
    }

    /**
     * Return one record.
     *
     * @param integer $id
     * @return object entity
     */
    public function getById($id)
    {
        $entity = $this->getEntityRepositoryInstance()->find($id);
        return $entity;
    }

    /**
     * Delete record in DB.
     *
     * @param integer $id
     * 
     * @return boolean
     */
    public function delete($id)
    {
        $entity = $this->getById($id);

        if ($entity !== null) {
            $this->getEntityManagerInstance()->remove($entity);
            $this->getEntityManagerInstance()->flush();
        }

        $entity = $this->getById($id);
        return ($entity === null);
    }

    /**
     * Insert or update record in DB.
     *
     * @param BaseEntity $entity
     * 
     * @return object entity
     */
    public function insertOrUpdate(BaseEntity $entity)
    {
        if ($entity->getId() != 0) {
            $modEntity = $entity;
            $entity = $this->getById($entity->getId());
            $this->setProperties($entity, $modEntity);
        } elseif (method_exists($entity, "setCreatedAt")) {
            $entity->setCreatedAt(new \DateTime('now'));
        }

        $this->getEntityManagerInstance()->persist($entity);
        $this->getEntityManagerInstance()->flush();

        return $this->getById($entity->getId());
    }

    /**
     * Set new values to update entity by reflection
     * 
     * @param BaseEntity $entity reference for record in DB
     * @param BaseEntity $modEntity entity with new values
     * 
     * @return void
     */
    private function setProperties(&$entity, &$modEntity)
    {
        $class = get_class($entity);
        $methods = get_class_methods($class);

        foreach ($methods as $method) {
            preg_match(' /^(set)(.*?)$/i', $method, $results);

            $pre = $results[1] ?? '';

            if ($pre == 'set') {
                $getMethod = str_replace('set', 'get', $method);
                $newValue = $modEntity->$getMethod();

                if (!empty($newValue)) {
                    $entity->$method($newValue);
                }
            }
        }
    }
}
