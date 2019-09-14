<?php

namespace App\RDias\Domain\Services;

use App\App\Domain\Payloads\Payload;
use App\App\Domain\ServiceInterface;
use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Payloads\NotFoundPayload;
use App\RDias\Domain\Repositories\Contracts\UserRepositoryInterface;

class UserListService implements ServiceInterface
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
            return new NotFoundPayload(['O usuário que você está tentando listar não existe']);
        }

        # Retorna um payload com status 200 (OK) e os dados do usuário.
        return new GenericPayload($user);
    }
}