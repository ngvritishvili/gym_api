<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'          => 'sometimes|string|between:3,40',
            'description'   => 'sometimes|string|between:3,340|nullable',
            'weight'        => 'sometimes|numeric',
            'price'         => 'sometimes|numeric:2',
            'images.*'      => 'sometimes|max:5192|nullable|mimes:jpg,png,jpeg'
        ];
    }
}
