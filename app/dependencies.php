<?php
// Dependency Container - Slim
// variable of ../config/bootstrap.php
$container = $app->getContainer();

// EntityManager - Doctrine
// variable of ../config/bootstrap.php
$container['entityManager'] = $entityManager;

// Logger - Monolog
$container['logger'] = function ($ci) {
    $logParams = $ci['settings']['logParams'];

    $logger = new \Monolog\Logger($logParams['name']);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($logParams['path'], $logParams['level']));
    return $logger;
};

// Swagger
$container['openapi'] = $openapi;

// AutoMapper
// variable of ../config/bootstrap.php
$container['mapper'] = $mapper;

// DAOs
$container['commentDAO'] = new \SlimSkeletonWebAPI\DAO\CommentDAO($entityManager);
$container['postDAO'] = new \SlimSkeletonWebAPI\DAO\PostDAO($entityManager);
$container['userDAO'] = new \SlimSkeletonWebAPI\DAO\UserDAO($entityManager);

// Controllers
$container['Controllers\CommentController'] = function ($ci) {
    return new \SlimSkeletonWebAPI\Controllers\CommentController($ci);
};

$container['Controllers\PostController'] = function ($ci) {
    return new \SlimSkeletonWebAPI\Controllers\PostController($ci);
};

$container['Controllers\UserController'] = function ($ci) {
    return new \SlimSkeletonWebAPI\Controllers\UserController($ci);
};
