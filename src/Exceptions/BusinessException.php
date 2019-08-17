<?php

namespace KuMEX\SDK\Exceptions;

use KuMEX\SDK\Http\ApiResponse;

class BusinessException extends \Exception
{
    /**
     * @var ApiResponse $response
     */
    protected $response;

    /**
     * @return ApiResponse
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param ApiResponse $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

}