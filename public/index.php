<?php
/**
 * Initialization
 */
require __DIR__ . '/../config/bootstrap.php';

session_start();

/**
 * Register Dependency Container
 */
require BASE_DIR . '/app/dependencies.php';

/**
 * Register Routes
 */
require BASE_DIR . '/app/routes/_routes.php';

/**
 * Run Slim
 */
$app->run();
