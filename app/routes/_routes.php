<?php
// Enable lazy CORS
$app->options('/{routes:.+}', function ($req, $res, $args) {
    return $res;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});
////

/**
 * @OA\Info(
 *      title="Slim Skeleton Web API", 
 *      version="1.0.0"
 * )
 * @OA\Server(url=API_HOST)
 */
$app->get('/api/v1/doc', function ($req, $res, $args) {
    return $res->write($this->openapi->toJson())->withHeader('Content-type', 'application/json');
});

require_once(BASE_DIR . '/app/routes/comment.php');

require_once(BASE_DIR . '/app/routes/post.php');

require_once(BASE_DIR . '/app/routes/user.php');