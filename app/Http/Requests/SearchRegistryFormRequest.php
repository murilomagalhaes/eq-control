<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRegistryFormRequest extends FormRequest
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
            'periodo' => "in:dt_entrada,dt_previsao,dt_entrega|nullable|required_with:periodo_de|required_with:periodo_ate",
            'periodo_de' => 'date|nullable|required_with:periodo',
            'periodo_ate' => 'date|nullable|required_with:periodo|required_with:periodo_ate|after:periodo_de',
            'cliente' => 'integer|nullable',
            'responsavel' => 'integer|nullable',
            'prioridade' => 'integer|between:1,4|nullable',
            'status' => 'nullable'
        ];
    }

}
