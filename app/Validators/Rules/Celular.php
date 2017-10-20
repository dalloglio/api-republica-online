<?php

namespace App\Validators\Rules;

use Illuminate\Validation\Validator;

trait Celular
{
    /**
     * The array of custom error messages.
     *
     * @var array
     */
    public function celularMessages()
    {
        $this->_messages['celular'] = 'O campo :attribute não é um celular válido.';
    }

    /**
    * Valida se o número do celular é válido
    *
    * @param string $attribute
    * @param string $value
    * @return boolean
    */
    protected function validateCelular($attribute, $value)
    {
        return preg_match('/^[1-9]{2}9[7-9][0-9]{3}[0-9]{4}$/', preg_replace('/\D/', '', $value)) > 0;
    }

    /**
    * Valida se o número/formato do celular é válido
    *
    * @param string $attribute
    * @param string $value
    * @return boolean
    */
    protected function validateFormatoCelular($attribute, $value)
    {
        return preg_match('/^\([1-9]{2}\) 9[7-9][0-9]{3}\-[0-9]{4}$/', $value) > 0;
    }
}
