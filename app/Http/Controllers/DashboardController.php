<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Registry;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    public function index()
    {
        $finalizados = Registry::where('dt_entrega', '<>', null)
            ->withCount(['equipments']);

        $pendentes = Registry::where('dt_entrega', null)
            ->where('dt_previsao', '>', now(), 'or', 'dt_previsao', null)
            ->withCount(['equipments']);

        $atrasados = Registry::where('dt_entrega', null)
            ->where('dt_previsao', '<', now())
            ->withCount(['equipments']);

        $equip_count = [
            'finalizados' => 0,
            'atrasados' => 0,
            'pendentes' => 0
        ];

        $reg_count = [
            'finalizados' => 0,
            'atrasados' => 0,
            'pendentes' => 0
        ];


        foreach ($finalizados->get() as $finalizado) {
            $equip_count['finalizados'] += $finalizado->equipments_count;
            $reg_count['finalizados'] += 1; 
        }

        foreach ($atrasados->get() as $atrasado) {
            $equip_count['atrasados'] += $atrasado->equipments_count;
            $reg_count['atrasados'] += 1; 
        }

        foreach ($pendentes->get() as $pendente) {
            $equip_count['pendentes'] += $pendente->equipments_count;
            $reg_count['pendentes'] += 1; 
        }

        return view('dashboard.index')->with([
            'reg_count' => $reg_count,
            'equip_count' => $equip_count
        ]);
    }
}
