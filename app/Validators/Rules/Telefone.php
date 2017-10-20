<?php

namespace App\Validators\Rules;

use Illuminate\Validation\Validator;

trait Telefone
{
    /**
     * The array of custom error messages.
     *
     * @var array
     */
    public function telefoneMessages()
    {
        $this->_messages['telefone'] = 'O campo :attribute não é um telefone válido.';
    }

    /**
    * Valida se o número do telefone é válido
    *
    * @param string $attribute
    * @param string $value
    * @return boolean
    */
    protected function validateTelefone($attribute, $value)
    {
        return preg_match('/^[1-9]{2}[2-3][0-9]{3}[0-9]{4}$/', preg_replace('/\D/', '', $value)) > 0;
    }

    /**
    * Valida se o número do telefone é válido
    *
    * @param string $attribute
    * @param string $value
    * @return boolean
    */
    protected function validateFormatoTelefone($attribute, $value)
    {
        return preg_match('/^\([1-9]{2}\) [2-3][0-9]{3}\-[0-9]{4}$/', $value) > 0;
    }
}
