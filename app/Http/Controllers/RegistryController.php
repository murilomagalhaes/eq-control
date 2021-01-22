<?php

namespace App\Http\Controllers;

use App\Models\Customer;
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

    public function store(Request $request)
    {
        dd($request);
    }
}
