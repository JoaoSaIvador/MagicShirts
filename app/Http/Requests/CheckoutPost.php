<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutPost extends FormRequest
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
            'nif' =>                'required|size:9',
            'morada' =>             'required',
            'notas' =>              'nullable',
            'metodo_pagamento' =>   'required|in:VISA,MC,PAYPAL',
            'ref_pagamento' =>      'required'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Tem que inserir o seu nome',
            'nif.required' => 'Tem que inserir o seu NIF',
            'nif.size' => 'O NIF tem de ter 9 digitos',
            'morada.required' => 'Tem que inserir a sua morada',
            'metodo_pagamento.required' => 'Tem que escolher um método de pagamento',
            'ref_pagamento.required' => 'Tem que inserir uma referência de pagamento'
        ];
    }
}
