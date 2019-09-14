<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TelefoneCelular implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Verificando se o valor passado é um telefone ou celular.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (
            preg_match('/^\(\d{2}\)\s?\d{4,5}-\d{4}$/', $value) > 0 ||
            preg_match('/^\(\d{2}\)\s?\d{4}-\d{4}$/', $value) > 0
        );
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O número de telefone informado é inválido';
    }
}
