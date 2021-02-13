<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRegistryFormRequest;
use App\Models\Registry;
use Illuminate\Support\Carbon;
use App\Exports\RegistriesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public static function search($request)
    {
        return Registry::with('equipments', 'customer')
            ->withCount('equipments')
            ->when($request->periodo, function ($registries) use ($request) {
                return $registries->whereBetween($request->periodo, [Carbon::parse($request->periodo_de), Carbon::parse($request->periodo_ate)]);
            })
            ->when($request->cliente, function ($registries) use ($request) {
                return $registries->where('customer_id', $request->cliente);
            })
            ->when($request->responsavel_id, function ($registries) use ($request) {
                return $registries->where('responsavel_id', $request->responsavel_id);
            })
            ->when($request->prioridade, function ($registries) use ($request) {
                return $registries->where('prioridade', $request->prioridade);
            })
            ->when($request->status, function ($registries) use ($request) {
                if ($request->status == 'entregue') {
                    $registries->where('dt_entrega', '<>', null);
                } else if ($request->status == 'pendente') {
                    $registries->where('dt_entrega', null)
                        ->where('dt_previsao', '>', now(), 'or', 'dt_previsao', null);
                } else if ($request->status == 'atrasado') {
                    $registries->where('dt_entrega', null)
                        ->where('dt_previsao', '<', now());
                }

                return $registries;
            })
            ->orderBy('created_at', 'desc')
            ->get();
    }


    public function process(SearchRegistryFormRequest $request)
    {
        $prioridades = ['Baixa', 'Média', 'Alta', 'Crítica'];
        $registries = self::search($request);
        $equip_count = 0;

        foreach ($registries as $registry) {
            $equip_count += $registry->equipments_count;
        }

        if ($request->action == 'view') {
            return view('reports.view')->with([
                'registries' => $registries,
                'equip_count' => $equip_count,
                'prioridades' => $prioridades
            ]);
        } else if ($request->action == 'print') {
            return view('reports.view')->with([
                'registries' => $registries,
                'equip_count' => $equip_count,
                'prioridades' => $prioridades,
                'print' => true
            ]);

        } else if ($request->action == 'excel') {

            return Excel::download(new RegistriesExport($registries), 'relatorio.xlsx');
        }

        return back()->with([
            'exception' => 'Ação inválida!'
        ]);
    }
}
