<?php
require_once(dirname(__DIR__, 1) . '/app/constants.php');
require_once(BASE_DIR . '/vendor/autoload.php');
require_once(BASE_DIR . '/config/app-config.php');
require_once(BASE_DIR . '/app/auto_mapper/startup.php');

/**
 * Init Swagger-PHP (http://zircote.com/swagger-php)
 */
$openapi = \OpenApi\scan(BASE_DIR . '/app/routes');

/**
 * Init Doctrine EntityManager (https://www.doctrine-project.org/projects/doctrine-orm/en/current/tutorials/getting-started.html)
 * \Doctrine\Common\Util\Debug::dump($entity);
 */
$entitiesPath = BASE_DIR . ENTITIES_PATH;
$paths = array($entitiesPath);
$metaConfig = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($paths, IS_DEV_MODE);
$entityManager = \Doctrine\ORM\EntityManager::create($config['dbParams'], $metaConfig);

/**
 * Init Slim App (https://www.slimframework.com/docs)
 */
$app = new \Slim\App(["settings" => $config]);
