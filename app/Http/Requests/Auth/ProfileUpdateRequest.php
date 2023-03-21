<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'first_name'=>'required|max:50',
            'last_name'=>'required|max:50',
            'phone'=>'digits_between:10:11|unique:users,phone,'.$this->user()->id,
            'gender'=>'sometimes|max:20',
            'email'=>'required|unique:users,email,'.$this->user()->id,
            'image'=>['image','mimes:jpg,png,jpeg,webp','max:2048'],
        ];
    }
}
