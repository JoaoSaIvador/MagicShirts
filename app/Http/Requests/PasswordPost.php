<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordPost extends FormRequest
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
            'password_atual' =>     'required',
            'nova_password' => 'bail|required|max:24||min:8',
            'conf_nova_password' => 'bail|required|max:24|min:8|same:nova_password'
        ];
    }

    public function messages()
    {
        return [
            'nova_password.required' => 'É obrigatório introduzir a password',
            'nova_password.max:24' => 'A password tem de ter entre 8 a 24 carateres',
            'nova_password.min:8' => 'A password tem de ter entre 8 a 24 carateres',
            'conf_nova_password.required' => 'É obrigatório introduzir a confirmação de password',
            'conf_nova_password.max:24' => 'A password tem de ter entre 8 a 24 carateres',
            'conf_nova_password.min:8' => 'A password tem de ter entre 8 a 24 carateres',
            'nova_password.same:nova_password' => 'As password têm de ser iguais'
        ];
    }
}
