<?php

namespace App\Http\Requests\User;

use App\Domains\User\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'birthday' => 'required|date|date_format:Y-m-d|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:6|max:20',
            'gender' => [
                'required',
                Rule::in(User::genders())
            ],
            'cpf' => 'required|cpf|unique:users,cpf',
            'status' => 'required|in:1,0',

            'address.zip_code' => 'required|max:9',
            'address.street' => 'required|max:255',
            'address.number' => 'required|max:20',
            'address.sub_address' => 'sometimes|nullable|max:255',
            'address.neighborhood' => 'required|max:255',
            'address.state' => 'required|max:255',
            'address.state_initials' => 'required|max:2',
            'address.city' => 'required|max:255',
        ];
    }
}
