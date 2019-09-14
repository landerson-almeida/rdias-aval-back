<?php

namespace App\RDias\Actions;

use App\App\Responders\ResponderInterface;
use App\RDias\Domain\Services\UsersListService;
use App\RDias\Responders\UsersListResponder;
use Illuminate\Http\Request;

class UsersListAction
{
    protected $service;

    protected $responder;

    public function __construct(UsersListService $service, UsersListResponder $responder)
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