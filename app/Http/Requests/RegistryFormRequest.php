<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\Parent_;

class RegistryFormRequest extends FormRequest
{
    private $rules = [];
    private $messages = [];

    public function __construct()
    {
        parent::__construct();

        if (!session('active_registry')) {
            $this->rules = [
                'cliente' => 'required',
                'nome' => 'required|min:3|max:40',
                'telefone' => 'required|min:10|max:11',
                'dt_entrada' => 'date|required|after_or_equal:' . now()->format('YYYY/mm/dd'),
                'dt_previsao' => 'date|after:dt_entrada|nullable',
                'responsavel' => 'required',
                'prioridade' => 'required'
            ];

            $this->messages =  [
                'dt_previsao.after' => 'A data de previsão deve ser posterior a data de entrada.'
            ];
        }
        
    }

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
        return $this->rules;
    }

    public function messages()
    {
        return $this->messages;
    }
}
