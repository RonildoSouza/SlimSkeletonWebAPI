<?php
namespace  SlimSkeletonWebAPI\Controllers;

use Slim\Container;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use SlimSkeletonWebAPI\Dtos\UserInputDto;
use SlimSkeletonWebAPI\Dtos\UserOutputDto;

final class UserController extends BaseController
{
    /**
     * @var \SlimSkeletonWebAPI\DAO\UserDAO
     */
    private $_userDAO;    

    public function __construct(Container $ci)
    {       
        $this->_userDAO = $ci->userDAO;

        parent::__construct($ci, $this->_userDAO, UserOutputDto::class, UserInputDto::class);
    }
}
