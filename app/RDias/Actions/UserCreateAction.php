<?php

namespace App\RDias\Actions;

use App\App\Responders\ResponderInterface;
use App\RDias\Domain\Services\UserCreateService;
use App\RDias\Responders\UserCreateResponder;
use Illuminate\Http\Request;

class UserCreateAction
{
    protected $service;

    protected $responder;

    public function __construct(UserCreateService $service, UserCreateResponder $responder)
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