<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerFormRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate();
        return view('customers.index')->with(compact('customers'));
    }

    public function form()
    {
        return view('customers.form');
    }

    public function store(StoreCustomerFormRequest $request)
    {
        $validated = $request->validated();

        //If it's an update...
        if ($request->id) {
            $customer = Customer::find($request->id);
            $customer->fill($validated);
            $customer->save();

            return redirect()->route('cadastros.cliente')->with([
                'store_success' => "Cliente '{$validated['nome']}' atualizado com sucesso!"
            ]);
        }

        //If it's an insert...
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
            'search' => $request->q
        ]);
    }

    public function show(Customer $customer)
    {
        return view('customers.form')
            ->with([
                'customer' => $customer
            ]);
    }
}
