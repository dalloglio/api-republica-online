<?php

namespace App\Validators\Rules;

use Illuminate\Validation\Validator;

trait OldPassword
{
    /**
     * The array of custom error messages.
     *
     * @var array
     */
    public function oldPasswordMessages()
    {
        $this->_messages['old_password'] = 'A senha antiga não confere.';
    }

    /**
    * Valida se a senha é válida
    *
    * @param string $attribute
    * @param string $value
    * @return boolean
    */
    protected function validateOldPassword($attribute, $value)
    {
        $user = request()->user();
        return \Hash::check($value, $user['password']);
    }
}
