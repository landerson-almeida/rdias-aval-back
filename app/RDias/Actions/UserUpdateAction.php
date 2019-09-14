<?php

namespace App\RDias\Actions;

use App\App\Responders\ResponderInterface;
use App\RDias\Domain\Services\UserUpdateService;
use App\RDias\Responders\UserUpdateResponder;
use Illuminate\Http\Request;

class UserUpdateAction
{
    protected $service;

    protected $responder;

    public function __construct(UserUpdateService $service, UserUpdateResponder $responder)
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