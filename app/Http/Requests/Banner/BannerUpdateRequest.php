<?php

namespace App\Http\Requests\Banner;

use App\Domains\Banner\Banner;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BannerUpdateRequest extends FormRequest
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
            'description' => 'sometimes|nullable|max:255',
            'link' => 'sometimes|nullable|url|max:255',
            'size' => [
                'required',
                Rule::in(Banner::keys())
            ],
        ];
    }
}
