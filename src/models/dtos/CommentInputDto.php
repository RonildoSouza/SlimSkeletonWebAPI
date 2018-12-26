<?php
namespace SlimSkeletonWebAPI\Dtos;

class CommentInputDto extends BaseInputDto
{
    public $text;
    public $post_id;
    public $user_id;
}
