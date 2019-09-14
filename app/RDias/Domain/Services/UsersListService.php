<?php

namespace App\RDias\Domain\Services;

use App\App\Domain\Payloads\Payload;
use App\App\Domain\ServiceInterface;
use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Payloads\NotFoundPayload;
use App\RDias\Domain\Repositories\Contracts\UserRepositoryInterface;

class UsersListService implements ServiceInterface
{
    protected $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function handle(array $data = []) : Payload
    {
        # Executa a ação para encontrar todos os usuário no banco de dados.
        $user = $this->user->getAll(false, false);

        # Retorna um payload com status 200 (OK) e os dados do usuário.
        return new GenericPayload($user);
    }
}