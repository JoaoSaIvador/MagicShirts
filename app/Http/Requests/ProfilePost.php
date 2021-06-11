<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilePost extends FormRequest
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
            'nome' =>               'required',
            'email' =>              'required',
            'nif' =>                'nullable|size:9',
            'morada' =>             'nullable',
            'metodo_pagamento' =>   'nullable|in:VISA,MC,PAYPAL',
            'ref_pagamento' =>      'nullable',
            'foto' =>               'nullable'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Tem que inserir o seu nome',
            'email.required' => 'Tem que inserir o seu email',
            'nif.size' => 'O NIF tem de ter 9 digitos',
        ];
    }
}
