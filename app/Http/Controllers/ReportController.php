<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRegistryFormRequest;
use App\Models\Registry;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    protected static function search($request)
    {
        return Registry::with('equipments', 'customer')
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

        if ($request->action == 'view') {

            $registries = self::search($request);
            return view('reports.view')->with([
                'registries' => $registries
            ]);
        } else if ($request->action == 'excel') {
            return 'EXCEL';
        } else if ($request->action == 'print') {
            return 'PRINT';
        }

        return back()->with([
            'exception' => 'Ação inválida!'
        ]);
    }
}
