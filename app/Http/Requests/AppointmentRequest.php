<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id'=>'required',
            //'doctor_id'=>'required',
            'specialization'=>'required|max:20',
            'day'=>'required|max:20',
            'month'=>'required|max:20',
            'year'=>'required|max:20',
            'hour'=>'required|max:20',
            'minute'=>'required|max:20',
    							
        ];
    }
}
