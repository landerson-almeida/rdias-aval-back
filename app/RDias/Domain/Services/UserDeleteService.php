<?php

namespace App\RDias\Domain\Services;

use App\App\Domain\Payloads\Payload;
use App\App\Domain\ServiceInterface;
use App\App\Domain\Payloads\DeletePayload;
use App\App\Domain\Payloads\NotFoundPayload;
use App\RDias\Domain\Repositories\Contracts\UserRepositoryInterface;

class UserDeleteService implements ServiceInterface
{
    protected $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function handle(array $data = []) : Payload
    {
        # Executa a ação para encontrar o usuário no banco de dados através do seu ID.
        $user = $this->user->find((int) request('id'));

        # Caso o usuário não existir, retorna um payload NotFound (404).
        if(!$user) {
            return new NotFoundPayload(['O usuário que você está tentando deletar não existe']);
        }

        # Retorna um payload com status 200 (OK) e o boolean do delete do usuário.
        return new DeletePayload($user->delete());
    }
}