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

    public function addEquipment(RegistryFormRequest $request)
    {

        /**
         *  Validates, and stores the registry data to the session
         *  and fowards it to the equipment form.
         */

        $validated = $request->validated();
        session()->flash('registry', $validated);

        return view('registries.equipments.form');
    }

    public function store(Request $request)
    {
        session()->reflash('registry');
        dd(session('registry'), $request);
    }
}
