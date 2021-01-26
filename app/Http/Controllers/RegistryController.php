<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipmentFormRequest;
use App\Http\Requests\RegistryFormRequest;
use App\Models\{Equipment, Registry};
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RegistryController extends Controller
{
    public function index()
    {
        $registries = Registry::with('equipments')->paginate(10);
        return view('registries.index', compact('registries'));
    }

    public function form()
    {
        return view('registries.form');
    }

    public function addEquipment(RegistryFormRequest $request)
    {

        /**
         *  Validates, and stores the registry data to the session
         *  and fowards it to the equipment form.
         */

        $validated = $request->validated();
        session()->put('registry', $validated);

        return view('registries.equipments.form');
    }

    public function store(EquipmentFormRequest $request)
    {

        //Revalidates registry stored in session
        Validator::make(
            session('registry'),
            [
                'cliente' => 'required',
                'nome' => 'required|min:3|max:40',
                'telefone' => 'required|min:10|max:11',
                'dt_entrada' => 'date|required|after_or_equal:' . now()->format('YYYY/mm/dd'),
                'dt_previsao' => 'date|after:dt_entrada|nullable',
                'responsavel' => 'required',
                'prioridade' => 'required'
            ],

            [
                'dt_previsao.after' => 'A data de previsão deve ser posterior a data de entrada.'
            ]
        )->validate();

        //Store form/sesison data as obj;
        $equipment = (object) $request->validated();

        $registry = (object) session('registry');

        DB::transaction(function () use ($registry, $equipment) {
            //Insert registry
            $created_registry = Registry::create([
                'customer_id' => $registry->cliente,
                'nome' => $registry->nome,
                'telefone' => $registry->telefone,
                'dt_entrada' => Carbon::parse($registry->dt_entrada),
                'dt_previsao' => $registry->dt_previsao ? Carbon::parse($registry->dt_previsao) : null,
                'responsavel_id' => $registry->responsavel,
                'prioridade' => $registry->prioridade,
                'created_by' => $registry->responsavel
            ]);

            //Insert equipment
            Equipment::create([
                'registry_id' => $created_registry->id,
                'type_id' => $equipment->tipo,
                'brand_id' => $equipment->marca,
                'num_serie' => $equipment->serie ?? null,
                'descricao' => $equipment->descricao,
                'problemas' => $equipment->problemas
            ]);
        });

        //Delete inserted data from session
        session()->forget('registry');

        return redirect()->route('registros');
    }

    public function show(Registry $registry)
    {
        return view('registries.show')->with([
            'registry' => $registry
        ]);
    }
}
