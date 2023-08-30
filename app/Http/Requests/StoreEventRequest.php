<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'name'               => 'required|string|max:25',
            'description'        => 'nullable|string|max:500',
            'limit'              => 'integer',
            'start_registration' => 'required|date',
            'end_registration'   => 'required|date',
            'start_event'        => 'required|date',
            'end_event'          => 'required|date',
            'logo'               => 'max:5192|nullable|mimes:jpg,png,jpeg,avif'
        ];
    }
}
