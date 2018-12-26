<?php

$app->get('/api/v1/comments', 'Controllers\CommentController:get');

$app->get('/api/v1/comments/{id}', 'Controllers\CommentController:getById');

$app->post('/api/v1/comments', 'Controllers\CommentController:createOrModify');

$app->put('/api/v1/comments/{id}', 'Controllers\CommentController:createOrModify');

$app->delete('/api/v1/comments/{id}', 'Controllers\CommentController:delete');
