<?php

namespace App\Validators;

use Illuminate\Validation\Validator as BaseValidator;

class Validator extends BaseValidator
{
    use Rules\Celular,
        Rules\Cnpj,
        Rules\Cpf,
        Rules\Telefone,
        Rules\OldPassword;

    /**
     * The array of custom error messages.
     *
     * @var array
     */
    protected $_messages = [];

    /**
     * Create a new Validator instance.
     *
     * @param  \Illuminate\Contracts\Translation\Translator  $translator
     * @param  array  $data
     * @param  array  $rules
     * @param  array  $messages
     * @param  array  $customAttributes
     * @return void
     */
    public function __construct(
        $translator,
        array $data,
        array $rules,
        array $messages,
        array $customAttributes
    ) {
        $this->loadMessages();
        $messages = $this->_messages;
        parent::__construct($translator, $data, $rules, $messages, $customAttributes);
    }

    public function loadMessages()
    {
        $this->celularMessages();
        $this->cnpjMessages();
        $this->cpfMessages();
        $this->telefoneMessages();
        $this->oldPasswordMessages();
    }
}
