<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewCustomerFormRequest extends FormRequest
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
            'nome' => 'max:60|min:4|required',
            'razao' => 'max:60|min:4|required',
            'cep' => 'min:9',
            'cidade' => 'max:60|min:4|required',
            'endereco' => 'min:4|required',
            'telefone' => 'min:10|max:11|required'
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}
