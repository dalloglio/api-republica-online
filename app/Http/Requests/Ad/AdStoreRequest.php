<?php

namespace App\Http\Requests\Ad;

use Illuminate\Foundation\Http\FormRequest;

class AdStoreRequest extends FormRequest
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
                'title' => 'required|max:255',
                'description' => 'required|max:500',
                'price' => 'required',
                'category_id' => 'required|exists:categories,id',
                'user_id' => 'required|exists:users,id',

                'address.zip_code' => 'required|max:9',
                'address.street' => 'required|max:255',
                'address.number' => 'required|max:20',
                'address.sub_address' => 'max:255',
                'address.neighborhood' => 'required|max:255',
                'address.state' => 'required|max:255',
                'address.state_initials' => 'required|max:2',
                'address.city' => 'required|max:255',

                'contact.name' => 'required|max:255',
                'contact.cellphone' => 'required|celular|max:15',
                'contact.whatsapp' => 'required|celular|max:15',
            ];
    }
}
