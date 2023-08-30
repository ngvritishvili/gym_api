<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'               => 'sometimes|string|max:25',
            'description'        => 'sometimes|string|max:500',
            'limit'              => 'sometimes|integer',
            'start_registration' => 'sometimes|date',
            'end_registration'   => 'sometimes|date',
            'start_event'        => 'sometimes|date',
            'end_event'          => 'sometimes|date',
            'logo'               => 'sometimes|max:5192|mimes:jpg,png,jpeg,avif'
        ];
    }
}
