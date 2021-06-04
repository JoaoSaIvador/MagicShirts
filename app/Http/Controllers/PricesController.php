<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PricesPost extends FormRequest
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
            'preco_un_catalogo'             =>  'required',
            'preco_un_proprio'              =>  'required',
            'preco_un_catalogo_desconto'    =>  'required',
            'preco_un_proprio_desconto'     =>  'required',
            'quantidade_desconto'           =>  'required'
        ];
    }

    public function messages()
    {
        return [
            //'nome.required' => 'Deve atribuir um nome à sua estampa',
            //'imagem_url.required' => 'Deve atribuir uma imagem à sua estampa',
        ];
    }
}
