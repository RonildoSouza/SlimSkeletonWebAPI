<?php
/**
 * Slim Configuration (https://www.slimframework.com/docs)
 */
$config['displayErrorDetails'] = IS_DEV_MODE;
$config['addContentLengthHeader'] = false;

/**
 * Database Connection Configuration
 */
$config['dbParams'] = array(
    'driver'   => 'pdo_sqlite', // pdo_mysql | pdo_pgsql | pdo_sqlsrv (http://php.net/manual/en/pdo.drivers.php)
    'path'     => BASE_DIR . '/app_data/db.sqlite',
    // 'host'     => 'localhost',
    // 'user'     => 'root',
    // 'password' => 'password',
    // 'dbname'   => 'name_db',
    // 'port'     => 3306,
);

/**
 * Monolog settings (https://github.com/Seldaek/monolog)
 */
$config['logParams'] = array(
    'name'  => APPLICATION_NAME,
    'path'  => BASE_DIR . '\logs\webapi.log',
    'level' => \Monolog\Logger::DEBUG,
);