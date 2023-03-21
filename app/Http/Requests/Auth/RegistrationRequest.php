<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
            'first_name'=>'required|max:30',
            'last_name'=>'required|max:30',
            'email'=>'required|unique:users,email',
            'phone'=>'required|unique:users,phone',
            'password'=>'required|min:8',
        ];
    }
}
