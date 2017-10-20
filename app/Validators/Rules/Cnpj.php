<?php

namespace App\Validators\Rules;

use Illuminate\Validation\Validator;

trait Cnpj
{
    /**
     * The array of custom error messages.
     *
     * @var array
     */
    public function cnpjMessages()
    {
        $this->_messages['cnpj'] = 'O campo :attribute não é um CNPJ válido.';
    }

    /**
    * Valida se o CNPJ é válido
    *
    * @param string $attribute
    * @param string $value
    * @return boolean
    */
    protected function validateCnpj($attribute, $value)
    {
        $c = preg_replace('/\D/', '', $value);
        $b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        if (strlen($c) != 14) {
            return false;
        }
        for ($i = 0, $n = 0; $i < 12; $n += $c[$i] * $b[++$i]);
        if ($c[12] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }
        for ($i = 0, $n = 0; $i <= 12; $n += $c[$i] * $b[$i++]);
        if ($c[13] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }
        return true;
    }
}
