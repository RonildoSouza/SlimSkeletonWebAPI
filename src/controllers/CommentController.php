<?php
namespace SlimSkeletonWebAPI\Controllers;

use Slim\Container;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use SlimSkeletonWebAPI\Entities\Comment;
use SlimSkeletonWebAPI\Dtos\CommentInputDto;
use SlimSkeletonWebAPI\Dtos\CommentOutputDto;

final class CommentController extends BaseController
{
    /**
     * @var \SlimSkeletonWebAPI\DAO\CommentDAO
     */
    private $_commentDAO;
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
        $this->_commentDAO = $ci->commentDAO;
        $this->_postDAO = $ci->postDAO;
        $this->_userDAO = $ci->userDAO;

        parent::__construct($ci, $this->_commentDAO, CommentOutputDto::class, CommentInputDto::class);
    }

    public function createOrModify(Request $request, Response $response, $args)
    {
        try {
            $inputDto = new CommentInputDto($request->getParsedBody());
            $inputDto->id = array_key_exists('id', $args) ? (int)$args['id'] : 0;

            $entityComment = $this->_mapper->map($inputDto, Comment::class);

            if ($inputDto->id == 0) {
                $entityPost = $this->_postDAO->getById($inputDto->post_id);
                $entityUser = $this->_userDAO->getById($inputDto->user_id);
                $entityComment->setPost($entityPost);
                $entityComment->setUser($entityUser);
            }

            $entityComment = $this->_commentDAO->insertOrUpdate($entityComment);

            $this->_resultDto = $this->_mapper->map($entityComment, CommentOutputDto::class);
        } catch (\Exception $ex) {
            $this->_error = $ex->getMessage();
        }

        $successStatusCode = $request->isPost() ? 201 : 200;
        return $this->CreateResponse($this->_resultDto, $response, $successStatusCode);
    }
}
