<?php

namespace U89Man\TBot\Exceptions;

use U89Man\TBot\Entities\Response;

class ResponseException extends EntityException
{
    /**
     * @var Response
     */
    protected $response;


    /**
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        parent::__construct($response->getDescription(), $response->getErrorCode());

        $this->response = $response;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }
}
