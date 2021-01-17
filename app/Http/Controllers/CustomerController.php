<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCustomerFormRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate();
        return view('customers.index')->with(compact('customers'));
    }

    public function new()
    {
        return view('customers.new');
    }

    public function store(NewCustomerFormRequest $request)
    {
        $validated = $request->validated();

        Customer::create($validated);

        return redirect()->route('cadastros.cliente')->with([
            'store_success' => "Cliente '{$validated['nome']}' cadastrado com sucesso!"
        ]);
    }

    public function search(Request $request)
    {
        $customers = Customer::where('nome', 'like', "%$request->q%")
        ->orwhere('razao', 'like', "%$request->q%")
        ->orwhere('cpf_cnpj', 'like', "%$request->q%")
        ->paginate();

        return view('customers.index')->with([
            'customers' => $customers,
            ''
        ]);
    }
}
