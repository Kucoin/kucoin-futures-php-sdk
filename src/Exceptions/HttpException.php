<?php

namespace KuCoin\Futures\SDK\Exceptions;

use KuCoin\Futures\SDK\Http\Request;
use KuCoin\Futures\SDK\Http\Response;

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