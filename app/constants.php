<?php
// SETTINGS

define('IS_DEV_MODE', true);
define("API_HOST", IS_DEV_MODE ? "http://localhost:8080" : "http://example.com");

// SIMPLE TEXTS

/**
 * Name Web API application
 */
define('APPLICATION_NAME', 'Slim Skeleton Web API');
define('VENDOR_NAME', 'RonildoSouza');
define('PACKAGE_NAME', 'SlimSkeletonWebAPI');

// PATHS

/**
 * root_path
 */
define('BASE_DIR', dirname(__DIR__, 1));
/**
 * /src/models/entities
 */
define('ENTITIES_PATH', '/src/models/entities');

// BASE NAMESPACE

define('ENTITY_NAMESPACE', PACKAGE_NAME . '\Entities\\');

// MESSAGES

/**
 * Registry does not exist!
 */
define('MSG_REGISTRY_NOT_EXIST', 'Registry does not exist!');