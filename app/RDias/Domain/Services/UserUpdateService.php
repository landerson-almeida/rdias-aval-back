<?php

namespace App\RDias\Domain\Services;

use App\Rules\CPF;
use Illuminate\Support\Arr;
use App\Rules\TelefoneCelular;
use App\App\Domain\Payloads\Payload;
use App\App\Domain\ServiceInterface;
use App\App\Domain\Payloads\GenericPayload;

# Regras de validação
use App\App\Domain\Payloads\NotFoundPayload;
use App\App\Domain\Payloads\ValidationPayload;
use Illuminate\Contracts\Validation\Validator;
use App\RDias\Domain\Repositories\Contracts\UserRepositoryInterface;

class UserUpdateService implements ServiceInterface
{
    protected $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function handle(array $data = []) : Payload
    {
        if ( ($validator = $this->validate($data))->fails() )
            return new ValidationPayload($validator->getMessageBag());

        # Executa a ação para atualizar o usuário através do repositório.
        $user = $this->user->find((int) request('id'));

        # Caso o usuário não existir, retorna um payload NotFound (404).
        if(!$user) {
            return new NotFoundPayload(['O usuário que você está tentando editar não existe']);
        }

        # Atualiza os dados do usuário com excessão do CPF e e-mail.
        $user->update(Arr::except($data, ['CPF', 'email']));

        # Retorna um payload com status 200 (OK) e os dados do usuário atualizado.
        return new GenericPayload($user);
    }

    /*----------  Validação  ----------*/

    private function validate(array $data) : Validator
    {
        return validator($data, [
            'telefone' => [new TelefoneCelular]
        ]);
    }
}