<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $loginFacebook = request('facebook', false);
        if ($loginFacebook) {
            return [
                'email' => 'required|email|max:255',
            ];
        } else {
            return [
                'nome' => 'max:255',
                'email' => 'required|email|unique:users,email|max:255',
                'password' => 'required|between:6,20|confirmed',
            ];
        }
    }
}
