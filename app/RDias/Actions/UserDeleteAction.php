<?php

namespace App\RDias\Actions;

use App\App\Responders\ResponderInterface;
use App\RDias\Domain\Services\UserDeleteService;
use App\RDias\Responders\UserDeleteResponder;
use Illuminate\Http\Request;

class UserDeleteAction
{
    protected $service;

    protected $responder;

    public function __construct(UserDeleteService $service, UserDeleteResponder $responder)
    {
        $this->service = $service;
        $this->responder = $responder;
    }

    public function __invoke(Request $request)
    {
        return $this->responder->withResponse(
            $this->service->handle($request->all())
        )->respond();
    }
}