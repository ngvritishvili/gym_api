<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class PhoneVerificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        $user = User::find($this->route('id'));

        return $this->route('code') == $user->phoneCode->code
            && $user->phoneCode->updated_at < now()->addMinute(260);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }

    /**
     * set user verified by phone.
     *
     * @return bool
     */
    public function fulfillPhone(): bool
    {
        $user = User::find($this->route('id'));

        return $user->update([
            'phone_verified_at' => now()->toDateTimeString()
        ]);
    }
}
