<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorereservationsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    /*public function rules(): array
    {
        return [
            //
            'customer_id'=> 'required',
            'number_of_people'=>'required',
            'type'=> 'required|string|in:reguler,vip,outdoor',
            'date'=> 'required|date|after_or_equal:today',
            'time'=> 'required',
        ];
    }*/
}
