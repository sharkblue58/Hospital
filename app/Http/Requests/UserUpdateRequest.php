<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'first_name'=>'sometimes|max:50',
            'last_name'=>'sometimes|max:50',
            'email'=>'sometimes|unique:users,email',
            'phone'=>'sometimes|unique:users,phone|digits_between:10,20',
            'password'=>'sometimes|min:6',
            'gender'=>'sometimes|max:20',
            'role'=>'sometimes|max:20',
        ];
    }
}
