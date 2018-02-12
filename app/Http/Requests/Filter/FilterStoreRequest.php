<?php

namespace App\Http\Requests\Filter;

use App\Domains\Filter\Filter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterStoreRequest extends FormRequest
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
            'description' => 'required|max:255',
            'order' => 'required',
            'type' => [
                'required',
                Rule::in(Filter::keys())
            ],
            'values' => 'required|array',
        ];
    }
}
