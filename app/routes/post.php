<?php

$app->get('/api/v1/posts', 'Controllers\PostController:get');

$app->get('/api/v1/posts/{id}', 'Controllers\PostController:getById');

$app->post('/api/v1/posts', 'Controllers\PostController:createOrModify');

$app->put('/api/v1/posts/{id}', 'Controllers\PostController:createOrModify');

$app->delete('/api/v1/posts/{id}', 'Controllers\PostController:delete');
