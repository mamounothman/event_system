<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookingDiscountRequest extends FormRequest
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
             * @example 30% discount for first 30% guests
             */
            'description' => ['required'],

            /**
             * @example percentage
             */
            // 'type' => ['required', 'in:percentage,fixed'],

            /**
             * @example 0.10
             */
            'rule' => ['required', 'numeric', 'between:0.01,1.00'],

            /**
             * @example 33
             */
            'discount_amount' => ['required', 'numeric'],

            /**
             * @example 0
             */
            'invert' => ['required', 'numeric'],
        ];
    }
}
