<?php

namespace App\RDias\Responders;

use App\App\Domain\Payloads\BadRequestPayload;
use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;

use App\RDias\Domain\Resources\UserResource;

class UsersListResponder extends Responder implements ResponderInterface
{
    public function respond()
    {
        if ($this->response instanceof BadRequestPayload) {
            return response()->json($this->response->getData(), $this->response->getStatus());
        }

        return (new UserResource($this->response->getData()))
            ->response()
            ->setStatusCode($this->response->getStatus());
    }
}