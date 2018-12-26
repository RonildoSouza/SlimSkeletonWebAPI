<?php
use SlimSkeletonWebAPI\Entities\Post;
use SlimSkeletonWebAPI\Entities\User;
use SlimSkeletonWebAPI\Entities\Comment;
use SlimSkeletonWebAPI\Dtos\PostInputDto;
use SlimSkeletonWebAPI\Dtos\UserInputDto;
use SlimSkeletonWebAPI\Dtos\CommentInputDto;
use AutoMapperPlus\MappingOperation\Operation;
use AutoMapperPlus\Configuration\AutoMapperConfig;

/**
 * Function for DTO to entity register Mapping
 * 
 * @param AutoMapperPlus\Configuration\AutoMapperConfig by refer
 * 
 * @return void
 */
function dtoToEntityRegisterMapping(AutoMapperConfig &$config)
{
    // Comment input mapping
    $config->registerMapping(CommentInputDto::class, Comment::class);

    // Post input mapping
    $config->registerMapping(PostInputDto::class, Post::class);

    // User input mapping
    $config->registerMapping(UserInputDto::class, User::class);
}
