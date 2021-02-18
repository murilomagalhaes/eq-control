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

    public function ajax(Request $request, int $id = 0)
    {
        $data = [];

        if ($id) {
            $data = Customer::select('id', 'nome', 'cpf_cnpj')
                ->where('id', $id)
                ->where('ativo', true)
                ->first();

            return response()->json($data);
        }


        if (!$request->has('q')) {
            $data = Customer::select('id', 'nome', 'cpf_cnpj')->where('ativo', true)->limit(10)->get();
        } else {
            $data = Customer::select('id', 'nome', 'cpf_cnpj')
                ->where('nome', 'LIKE', "%$request->q%")
                ->where('ativo', true)
                ->limit(10)
                ->get();
        }

        return response()->json($data);
    }

    public function store(StoreCustomerFormRequest $request)
    {
        $validated = $request->validated();

        if (!isset($validated['ativo'])) {
            $validated['ativo'] = 0;
        }

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

    public function destroy(Request $request)
    {
        $customer = Customer::find($request->customer_id);

        if ($customer) {
            $nome = $customer->nome;
            $customer->delete();

            return redirect()->route('cadastros.cliente')->with([
                'delete_success' => "Cliente '$nome' deletado com sucesso!"
            ]);
        }

        return redirect()->route('cadastros.cliente')->with([
            'delete_success' => "Erro inesperado."
        ]);
    }
}
