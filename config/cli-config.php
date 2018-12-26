<?php
require_once(__DIR__ . '/bootstrap.php');

/**
 * Config Doctrine CLI
 * 
 *                 COMMANDS CLI
 * > vendor/bin/doctrine orm:schema-tool:create
 * > vendor/bin/doctrine orm:schema-tool:drop --force
 * > vendor/bin/doctrine orm:schema-tool:create
 * > vendor/bin/doctrine orm:schema-tool:update --force --dump-sql
 * 
 */
if (IS_DEV_MODE) {
    // Register EntityManager in the CLI
    return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
}