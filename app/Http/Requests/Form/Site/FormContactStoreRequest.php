<?php

namespace App\Http\Requests\Form\Site;

use Illuminate\Foundation\Http\FormRequest;

class FormContactStoreRequest extends FormRequest
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
        $form = $this->route('form');

        switch ($form->id) {
            case 1:
                $rules = [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255',
                    'phone' => 'required|max:15',
                    'city' => 'required|max:255',
                    'state' => 'required|max:255',
                    'subject' => 'required|max:255',
                    'message' => 'required|max:1000',
                ];
                break;

            case 2:
                $rules = [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255',
                ];
                break;

            case 3:
                $rules = [
                    'resume' => 'required',
                ];
                break;
            
            default:
                $rules = [
                	'teste' => 'required'
                ];
                break;
        }

        return $rules;
    }
}
