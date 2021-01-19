<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserFormRequest extends FormRequest
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
        $rules =  [
            'nome' => 'max:60|min:4|required',
            'cpf' => "max:11|min:11|nullable|unique:users,cpf,$this->id",
            'email' => 'email|nullable',
            'telefone' => 'digits_between:10,11|nullable',
            'login' => "alpha_dash|required|unique:users,login,$this->id",
        ];
        
        // If it's an update (The requrest has an 'id' field) the password is not required  
        if ($this->id && $this->password) {
            $rules['password'] = 'confirmed';
        } elseif (!$this->id) {
            $rules['password'] = 'required|confirmed';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'password.confirmed' => 'O campo de confirmação de senha não confere.'
        ];
    }
}
