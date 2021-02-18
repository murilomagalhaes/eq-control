<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerFormRequest extends FormRequest
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
            'cpf_cnpj' => "digits_between:11,14|required|unique:customers,cpf_cnpj,$this->id",
            'email' => 'email|nullable',
            'telefone' => 'digits_between:10,11|required',
            'cep' => 'digits:8|nullable',
            'uf' => 'max:2|required',
            'cidade' => 'max:60|min:4|required',
            'endereco' => 'min:4|required',
            'ativo' => 'boolean'
        ];
    }

    public function messages()
    {
        return [
            'razao.required' => 'O campo razão social é obrigatório',
            'razao.min' => 'O campo razão social deve ter pelo menos 4 caracteres',
            'cpf_cnpj.required' => 'O campo CPF/CNPJ é obrigatório.',
            'cpf_cnpj.digits_between' => 'O campo CPF/CNPJ deve ter entre 11 e 14 dígitos',
            'cpf_cnpj.unique' => 'O CPF/CNPJ já está sendo usado em outro cadastro.',
            'endereco.required' => 'O campo endereço é obrigatório',
            'endereco.min' => 'O campo endereço deve ter pelo menos 4 caractéres'
        ];
    }
}
