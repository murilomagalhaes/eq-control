<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EquipmentType;

class EquipmentTypeController extends Controller
{
    public function index()
    {
        $equipment_types = EquipmentType::paginate();
        return view('equipments_types.index')->with(compact('equipment_types'));
    }

    public function form()
    {
        return view('equipments_types.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "nome" => "required|min:4|max:40|unique:equipment_types,nome,$request->id"
        ], [
            'nome.unique' => "O nome '$request->nome' já está sendo utilizado em outro cadastro."
        ]);

        //If it's an update...
        if ($request->id) {
            $equipment_type = EquipmentType::find($request->id);

            $equipment_type->fill($validated);
            $equipment_type->save();

            return redirect()->route('cadastros.tipo')->with([
                'store_success' => "Tipo '{$validated['nome']}' atualizado com sucesso!"
            ]);
        }

        //If it's an insert...
        EquipmentType::create($validated);

        return redirect()->route('cadastros.tipo')->with([
            'store_success' => "Tipo '{$validated['nome']}' cadastrado com sucesso!"
        ]);
    }

    public function search(Request $request)
    {
        $equipment_types = EquipmentType::where('nome', 'like', "%$request->q%")
            ->paginate();

        return view('equipments_types.index')->with([
            'equipment_types' => $equipment_types,
            'search' => $request->q
        ]);
    }

    public function show(EquipmentType $equipment_type)
    {
        return view('equipments_types.form', compact('equipment_type'));
    }
}
