<?php
namespace SlimSkeletonWebAPI\Dtos;

class BaseInputDto
{    
    public function __construct(array $properties = array())
    {
        foreach ($properties as $key => $value) {
            $this->{$key} = $value;
        }
    }
}