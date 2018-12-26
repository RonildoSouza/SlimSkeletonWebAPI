<?php
namespace SlimSkeletonWebAPI\Controllers;

use Slim\Container;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use SlimSkeletonWebAPI\DAO\BaseDAO;
use SlimSkeletonWebAPI\Dtos\ResponseDto;

class BaseController
{
    /**
     * @var \SlimSkeletonWebAPI\DAO\BaseDAO
     */
    private $_baseDAO;
    /**
     * @var \SlimSkeletonWebAPI\Dtos\ResponseDto
     */
    private $_responseDto;
    /**
     * @var string
     */
    private $_outputDtoClass;
    /**
     * @var string
     */
    private $_inputDtoClass;
    /**
     * @var string
     */
    private $_entityClass;
    
    /**
     * @var \AutoMapperPlus\AutoMapper
     */
    protected $_mapper;
    /**
     * @var \Monolog\Logger
     */
    protected $_logger;
    /**
     * @var string
     */
    protected $_error;
    /**
     * @var object
     */
    protected $_resultDto;

    public function __construct(Container $ci, BaseDAO $baseDAO, $outputDtoClass, $inputDtoClass)
    {
        $this->_baseDAO = $baseDAO;
        $this->_mapper = $ci->mapper;
        $this->_logger = $ci->logger;
        $this->_error = null;
        $this->_resultDto = null;

        $this->_responseDto = new ResponseDto();        
        $this->_outputDtoClass = $outputDtoClass;
        $this->_inputDtoClass = $inputDtoClass;
        $this->_entityClass = $this->_baseDAO->getEntityClass();
    }

    public function get(Request $request, Response $response, $args)
    {
        try {
            $entities = $this->_baseDAO->getAll();
            $this->_resultDto = $this->_mapper->mapMultiple($entities, $this->_outputDtoClass);
        } catch (\Exception $ex) {
            $this->_error = $ex->getMessage();
        }

        return $this->CreateResponse($this->_resultDto, $response);
    }

    public function getById(Request $request, Response $response, $args)
    {
        try {
            $entity = $this->_baseDAO->getById($args['id']);
            $this->_resultDto = $this->_mapper->map($entity, $this->_outputDtoClass);
        } catch (\Exception $ex) {
            $this->_error = $ex->getMessage();
        }

        return $this->CreateResponse($this->_resultDto, $response);
    }

    public function createOrModify(Request $request, Response $response, $args)
    {        
        try {     
            $inputDto = new $this->_inputDtoClass($request->getParsedBody());
            $inputDto->id = array_key_exists('id', $args) ? (int)$args['id'] : 0;

            $entity = $this->_mapper->map($inputDto, $this->_entityClass);
            $entity = $this->_baseDAO->insertOrUpdate($entity);
            
            $this->_resultDto = $this->_mapper->map($entity, $this->_outputDtoClass);
        } catch (\Exception $ex) {
            $this->_error = $ex->getMessage();
        }

        $successStatusCode = $request->isPost() ? 201 : 200;
        return $this->CreateResponse($this->_resultDto, $response, $successStatusCode);
    }

    public function delete(Request $request, Response $response, $args)
    {
        $result = false;

        try {
            $result = $this->_baseDAO->delete((int)$args['id']);
        } catch (\Exception $ex) {
            $this->_error = $ex->getMessage();
        }

        $successStatusCode = $result ? 200 : 204;
        return $this->CreateResponse($result, $response, $successStatusCode);
    }

    protected function CreateResponse($resultDto, Response $response, $successStatusCode = 200)
    {
        $this->_responseDto->data = $resultDto;

        if ($this->_error !== null || isset($this->_error)) {
            $this->_responseDto->isValid = false;
            $this->_responseDto->message = $this->_error;

            return $response->withJSON($this->_responseDto, 400);
        } else {
            $this->_responseDto->isValid = true;
            $this->_responseDto->message = 'success';

            if (is_array($resultDto)) {
                $this->_responseDto->total = count($resultDto);
            } else {
                $this->_responseDto->total = 1;
            }

            return $response->withJSON($this->_responseDto, $successStatusCode)->withHeader('Content-type', 'application/json');
        }
    }
}
