<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipmentFormRequest;
use App\Models\Equipment;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipmentController extends Controller
{
    public function form(Equipment $equipment)
    {
        return view('registries.equipments.form', compact('equipment'));
    }

    public function update(EquipmentFormRequest $request)
    {
        $equipment = Equipment::find($request->id);

        if ($equipment) {

            $equipment->fill([
                'type_id' => $request->tipo,
                'brand_id' => $request->marca,
                'num_serie' => $request->serie ?? null,
                'descricao' => $request->descricao,
                'problemas' => $request->problemas,
                'updated_by' => Auth::user()->id
            ]);

            $equipment->save();

            return redirect()->route('registros.mostrar', $equipment->registry_id)->with([
                'store_success' => "Registro $equipment->registry_id editado com sucesso!"
            ]);
        }

        return redirect()->route('registros')->with([
            'inesperado' => "Erro inesperado!"
        ]);
    }
}
