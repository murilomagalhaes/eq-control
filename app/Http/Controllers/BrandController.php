<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::paginate();
        return view('brands.index')->with(compact('brands'));
    }

    public function form()
    {
        return view('brands.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "nome" => "required|min:2|max:40|unique:brands,nome,$request->id"
        ], [
            'nome.unique' => "O nome '$request->nome' já está sendo utilizado em outro cadastro."
        ]);

        //If it's an update...
        if ($request->id) {
            $brand = Brand::find($request->id);

            $brand->fill($validated);
            $brand->save();

            return redirect()->route('cadastros.marca')->with([
                'store_success' => "Marca '{$validated['nome']}' atualizada com sucesso!"
            ]);
        }

        //If it's an insert...
        Brand::create($validated);

        return redirect()->route('cadastros.marca')->with([
            'store_success' => "Marca '{$validated['nome']}' cadastrada com sucesso!"
        ]);
    }

    public function ajax(Request $request, int $id = 0)
    {
        $data = [];

        if ($id) {

            $data = Brand::select('id', 'nome')
                ->where('id', $id)
                ->first();

            return response()->json($data);
        }

        if (!$request->has('q')) {
            $data = Brand::select('id', 'nome')->limit(10)->get();
        } else {
            $data = Brand::select('id', 'nome')
                ->where('nome', 'LIKE', "%$request->q%")
                ->limit(10)
                ->get();
        }

        return response()->json($data);
    }

    public function search(Request $request)
    {
        $brands = Brand::where('nome', 'like', "%$request->q%")
            ->paginate();

        return view('brands.index')->with([
            'brands' => $brands,
            'search' => $request->q
        ]);
    }

    public function show(Brand $brand)
    {
        return view('brands.form')
            ->with([
                'brand' => $brand
            ]);
    }
}
