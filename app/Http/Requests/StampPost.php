<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StampPost extends FormRequest
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
            'nome' =>            'required',
            'categoria_id' =>    'nullable',
            'descricao' =>       'nullable',
            'imagem_url' =>      'required|image|max:8192',
            'informacao_extra' =>'nullable'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Deve atribuir um nome à sua estampa',
            'imagem_url.required' => 'Deve atribuir uma imagem à sua estampa',
        ];
    }
}
