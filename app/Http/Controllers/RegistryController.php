<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipmentFormRequest;
use App\Http\Requests\RegistryFormRequest;
use App\Models\{Equipment, Registry};
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use stdClass;

class RegistryController extends Controller
{
    public function index()
    {
        //Clean possible session data created on another requests
        session()->forget('registry');
        session()->forget('active_registry');
        session()->forget('registry_id');

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
         *  If there's an created registry with more equipments being inserted
         *  Validation will not be done again
         */
        if (session('active_registry')) {
            return view('registries.equipments.form');
        }

        // Validates form and stores data on the session before the next request
        $validated = $request->validated();
        session()->put('registry', $validated);

        return view('registries.equipments.form');
    }

    public function store(EquipmentFormRequest $request)
    {
        //Store form/sesison data as obj;
        $equipment = (object) $request->validated();
        $registry = (object) session('registry');

        $created_registry = new stdClass();

        DB::transaction(function () use ($registry, $equipment, &$created_registry) {

            if (!session('active_registry')) {
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

                session()->put('registry_id', $created_registry->id);
            }

            //Insert equipment
            Equipment::create([
                'registry_id' => session('registry_id') ?? $created_registry->id,
                'type_id' => $equipment->tipo,
                'brand_id' => $equipment->marca,
                'num_serie' => $equipment->serie ?? null,
                'descricao' => $equipment->descricao,
                'problemas' => $equipment->problemas
            ]);
        });

        //Informs that there's an active registry
        session()->put('active_registry', true);

        //Removes the inserted registry data from the session
        session()->forget('registry');

        if (isset($equipment->add_more) && $equipment->add_more == 1) {

            return redirect()->route('registros.equipamento.incluir');
        }

        //When the user won't add another equipment to the registry...
        session()->forget('active_registry');
        session()->forget('registry_id');

        return redirect()->route('registros')->with([
            'store_success' => 'Registro adicionado com sucesso!'
        ]);
    }

    public function show(Registry $registry)
    {
        return view('registries.show')->with([
            'registry' => $registry
        ]);
    }

    public function print(Registry $registry)
    {
        $prioridades = ['Baixa', 'Média', 'Alta', 'Crítica'];    
        
        return view('prints.entrega')->with([
            'registry' => $registry,
            'prioridades' => $prioridades
        ]);
    }
}
