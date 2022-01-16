<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeRegisterRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => 'bail|required|between:8,255',
            'username' => 'bail|required|unique:users|between:8,255',
            'email' => ['bail', 'required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:5', 'max:255']
        ];
    }
}
