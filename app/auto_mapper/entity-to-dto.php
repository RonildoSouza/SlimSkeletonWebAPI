<?php
use SlimSkeletonWebAPI\Entities\Post;
use SlimSkeletonWebAPI\Entities\User;
use SlimSkeletonWebAPI\Entities\Comment;
use SlimSkeletonWebAPI\Dtos\PostOutputDto;
use SlimSkeletonWebAPI\Dtos\UserOutputDto;
use SlimSkeletonWebAPI\Dtos\CommentOutputDto;
use AutoMapperPlus\MappingOperation\Operation;
use AutoMapperPlus\Configuration\AutoMapperConfig;

/**
 * Function for entity to DTO register Mapping
 * 
 * @param AutoMapperPlus\Configuration\AutoMapperConfig by refer
 * 
 * @return void
 */
function entityToDtoRegisterMapping(AutoMapperConfig &$config)
{
    // Comment output mapping
    $config
        ->registerMapping(Comment::class, CommentOutputDto::class)
        ->forMember("post_id", function(Comment $source){
            return $source->getPost()->getId();
        })
        ->forMember("user_name", function(Comment $source){
            return $source->getUser()->getName();
        });

    // Post output mapping
    $config
        ->registerMapping(Post::class, PostOutputDto::class)
        ->forMember("user_name", function(Post $source){
            return $source->getUser()->getName();
        })
        ->forMember("comments", Operation::mapCollectionTo(CommentOutputDto::class));
    
    // User output mapping
    $config->registerMapping(User::class, UserOutputDto::class);
}
