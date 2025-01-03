<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            /**
             * @example my John doe
             */
            'name' => 'required|string|max:255',

            /**
             * @example johndoe@email.com
             */
            'email' => 'required|string|email|max:255|unique:users',

            /**
             * @example password
             */
            'password' => 'required|string|min:8|confirmed',

            /**
             * @example password
             */
            'password_confirmation' => 'required|string|min:8'
        ];
    }
}
