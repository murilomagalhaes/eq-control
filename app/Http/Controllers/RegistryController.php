<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistryFormRequest;
use Illuminate\Http\Request;

class RegistryController extends Controller
{
    public function index()
    {
        return view('registries.index');
    }

    public function form()
    {
        return view('registries.form');
    }

    public function addEquipment(Request $request)
    {
        $request->session()->reflash();
        dd($request->session()->getOldInput());
    }

    public function addRegistry(RegistryFormRequest $request)
    {
        $request->validated();
        $request->input()->flash();

        return view('registries.equipments.form');
    }
}
