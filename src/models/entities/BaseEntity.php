<?php
namespace SlimSkeletonWebAPI\Entities;

class BaseEntity
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     *
     * @var int
     */
    protected $id;

    public function getId()
    {
        return $this->id;
    }
}