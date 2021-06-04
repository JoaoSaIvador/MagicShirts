<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorPost extends FormRequest
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
            'codigo' =>     'required',
            'nome'   =>     'required',
        ];
    }

    public function messages()
    {
        return [
            'codigo.required' => 'Deve inserir um código para a cor',
            'nome.required'   => 'Deve inserir um nome para a cor',
        ];
    }
}
