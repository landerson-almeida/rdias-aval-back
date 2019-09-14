<?php

namespace App\RDias\Actions;

use App\App\Responders\ResponderInterface;
use App\RDias\Domain\Services\UserListService;
use App\RDias\Responders\UserListResponder;
use Illuminate\Http\Request;

class UserListAction
{
    protected $service;

    protected $responder;

    public function __construct(UserListService $service, UserListResponder $responder)
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