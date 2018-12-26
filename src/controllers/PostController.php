<?php
namespace SlimSkeletonWebAPI\Controllers;

use Slim\Container;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use SlimSkeletonWebAPI\Entities\Post;
use SlimSkeletonWebAPI\Dtos\PostInputDto;
use SlimSkeletonWebAPI\Dtos\PostOutputDto;

final class PostController extends BaseController
{
    /**
     * @var \SlimSkeletonWebAPI\DAO\PostDAO
     */
    private $_postDAO;
    /**
     * @var \SlimSkeletonWebAPI\DAO\UserDAO
     */
    private $_userDAO;

    public function __construct(Container $ci)
    {
        $this->_postDAO = $ci->postDAO;
        $this->_userDAO = $ci->userDAO;

        parent::__construct($ci, $this->_postDAO, PostOutputDto::class, PostInputDto::class);
    }

    public function createOrModify(Request $request, Response $response, $args)
    {
        try {
            $inputDto = new PostInputDto($request->getParsedBody());
            $inputDto->id = array_key_exists('id', $args) ? (int)$args['id'] : 0;

            $entityPost = $this->_mapper->map($inputDto, Post::class);

            if ($inputDto->id == 0) {
                $entityUser = $this->_userDAO->getById($inputDto->user_id);
                $entityPost->setUser($entityUser);
            }

            $entityPost = $this->_postDAO->insertOrUpdate($entityPost);

            $this->_resultDto = $this->_mapper->map($entityPost, PostOutputDto::class);
        } catch (\Exception $ex) {
            $this->_error = $ex->getMessage();
        }

        $successStatusCode = $request->isPost() ? 201 : 200;
        return $this->CreateResponse($this->_resultDto, $response, $successStatusCode);
    }
}
