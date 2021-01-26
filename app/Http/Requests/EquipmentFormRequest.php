<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquipmentFormRequest extends FormRequest
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
            'marca' => 'required',
            'tipo' => 'required',
            'descricao' => 'required',
            'problemas' => 'required',
            'serie' => 'nullable',
            'add_more' => 'nullable|boolean'
        ];
    }
}
