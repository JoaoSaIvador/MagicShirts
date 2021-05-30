<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderPost extends FormRequest
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
            'estado' =>      'required|in:pendente,fechada,anulada,paga',
        ];
    }

    public function messages()
    {
        return [
            'estado.required' => 'Deve selecionar uma das opções para o estado',
        ];
    }
}
