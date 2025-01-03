<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
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
             * @example my example
             */
            'title' => ['required'],

            /**
             * @example Lorem ipsum dolor sit amet, consectetur adipiscing elit
             */
            'description' => ['required'],

            /**
             * @example 25
             */
            'capacity' => ['required', 'int'],

            /**
             * @example 2025-01-01 12:00:00
             */
            'start_date' => ['required', 'date'],

            /**
             * @example 2025-01-01 14:00:00
             */
            'end_date' => ['required', 'date'],

            /**
             * @example 1
             */
            'status' => ['numeric'],

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
            'discounts.*.id' => ['numeric'],

        ];
    }
}
