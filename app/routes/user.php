<?php

/**
 * @OA\Get(
 *     path="/api/v1/users",
 *     @OA\Response(response="200", description="Get list of users")
 * )
 */
$app->get('/api/v1/users', 'Controllers\UserController:get');

/**
 * @OA\Get(
 *      path="/api/v1/users/{id}",
 *      @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="User ID",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *      @OA\Response(response="200", description="Get user")
 * )
 */
$app->get('/api/v1/users/{id}', 'Controllers\UserController:getById');

/**
 * @OA\Post(
 *     path="/api/v1/users",
 *     @OA\RequestBody(
 *         description="Input data format",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 type="object",
 *                 @OA\Property(
 *                     property="name",
 *                     description="Name of the new user",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="login",
 *                     description="Login of the new user",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="password",
 *                     description="Password of the new user",
 *                     type="string"
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(response="200", description="Create new user")
 * )
 */
$app->post('/api/v1/users', 'Controllers\UserController:createOrModify');

/**
 * @OA\Put(
 *      path="/api/v1/users/{id}",
 *      @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="User ID",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         description="Input data format",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 type="object",
 *                 @OA\Property(
 *                     property="name",
 *                     description="Updated name of the user",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="password",
 *                     description="Updated password of the user",
 *                     type="string"
 *                 )
 *             )
 *         )
 *     ),
 *      @OA\Response(response="200", description="Update user")
 * )
 */
$app->put('/api/v1/users/{id}', 'Controllers\UserController:createOrModify');

/**
 * @OA\Delete(
 *      path="/api/v1/users/{id}",
 *      @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="User ID",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *      @OA\Response(response="200", description="Delete user")
 * )
 */
$app->delete('/api/v1/users/{id}', 'Controllers\UserController:delete');
