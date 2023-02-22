<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name'=>['required' , 'string' ],
            'last_name'=>['required' , 'string' ],
            'email'=>['required','email' , 'unique:users,email' ],
            'password'=>[ 'required' , 'string' ],
            'menu_name'=>['required' , 'string' ],
        ];
    }
}
