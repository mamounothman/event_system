<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookingRequest extends FormRequest
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
             * @example 1
             */
            'event_id' => ['required', 'numeric'],

            /**
             * @example 2025-01-01 14:00:00
             */
            'booking_date' => ['required', 'date'],

            /**
             * @example john doe
             */
            'guest_name' => ['required', 'max:255'],

            /**
             * @example johndoe@example.com
             */
            'guest_email' => ['required', 'email'],

            // /**
            //  * @example 25.00
            //  */
            // 'total_price' => ['required', 'decimal:2'],

            /**
             * @example 1
             */
            'prices.*.id' => ['required', 'numeric'],

            /**
             * @example first row seat
             */
            'prices.*.description' => ['required'],


            /**
             * @example 25.00
             */
            'prices.*.price' => ['required', 'numeric'],

            /**
             * @example 1
             */
            'prices.*.tickets_count' => ['required', 'numeric', 'gt:0'],
        ];
    }
}
