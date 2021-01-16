<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('clientes.index');
    }

    public function new()
    {
        return view('clientes.novo');
    }
}
