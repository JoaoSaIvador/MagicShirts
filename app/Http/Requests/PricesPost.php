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
            'preco_un_catalogo'          =>  'required|numeric',
            'preco_un_proprio'           =>  'required|numeric',
            'preco_un_catalogo_desconto' =>  'required|numeric',
            'preco_un_proprio_desconto'  =>  'required|numeric',
            'quantidade_desconto'        =>  'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'preco_un_catalogo.required'          => 'Tem que inserir um preço',
            'preco_un_proprio.required'           => 'Tem que inserir um preço',
            'preco_un_catalogo_desconto.required' => 'Tem que inserir um preço',
            'preco_un_proprio_desconto.required'  => 'Tem que inserir um preço',
            'quantidade_desconto.required'        => 'Tem que inserir um preço',
        ];
    }
}
