<?php

namespace KuMEX\SDK\Exceptions;

use KuMEX\SDK\Http\Request;
use KuMEX\SDK\Http\Response;

class HttpException extends \Exception
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param Request $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param Response $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

}