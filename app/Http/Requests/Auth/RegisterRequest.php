<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'username'       => ['required', 'string',  'max:255', 'unique:users'],
            'email'          => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'       => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->rules(['max:64'])],
            'is_customer'    => 'required|boolean',
        ];
    }

    /**
     * Prepare data for validation
     * Distinguish email and phone
     *
     * @return void
     * @throws ValidationException
     */
    public function prepareForValidation(): void
    {
      //
    }
}
