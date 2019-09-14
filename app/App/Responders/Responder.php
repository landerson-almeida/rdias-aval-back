<?php

namespace App\App\Responders;

abstract class Responder
{
    protected $response;

    protected $status = 200;

    public function withResponse($response)
    {
        $this->response = $response;

        return $this;
    }
}