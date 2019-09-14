<?php

namespace App\RDias\Domain\Services;

use App\App\Domain\Payloads\Payload;
use App\App\Domain\ServiceInterface;
use App\App\Domain\Payloads\CreatedPayload;
use App\App\Domain\Payloads\ValidationPayload;
use Illuminate\Contracts\Validation\Validator;
use App\RDias\Domain\Repositories\Contracts\UserRepositoryInterface;

# Regras de validação
use App\Rules\CPF;
use App\Rules\TelefoneCelular;

class UserCreateService implements ServiceInterface
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

        # Executa a ação para criar o usuário através do repositório do mesmo.
        $user = $this->user->create($data);

        # Retorna um payload com status 201 (Created) e os dados do usuário recém-cadastrado.
        return new CreatedPayload($user);
    }

    /*----------  Validação  ----------*/

    private function validate(array $data) : Validator
    {
        return validator($data, [
            'nome' => 'required',
            'CPF' => ['required', new CPF],
            'email' => 'required|email|unique:users',
            'telefone' => [new TelefoneCelular]
        ], [
            'nome.required' => 'Você precisa informar um nome',
            'CPF.required' => 'Você precisa informar um CPF',
            'email.required' => 'Você precisa informar um e-mail',
            'email.email' => 'O e-mail informado não é válido',
            'email.unique' => 'Já existe um usuário cadastrado para este e-mail',
        ]);
    }
}