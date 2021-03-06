<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserFormRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::paginate();
        return view('users.index')->with(compact('users'));
    }

    public function form()
    {
        return view('users.form');
    }

    public function store(StoreUserFormRequest $request)
    {
        $validated = $request->validated();

        if (!isset($validated['ativo'])) {
            $validated['ativo'] = 0;
        }

        //If it's an update...
        if ($request->id) {
            $user = User::find($request->id);

            $form_data = [
                'nome' => $validated['nome'],
                'cpf' => $validated['cpf'],
                'login' => $validated['login'],
                'telefone' => $validated['telefone'],
                'email' => $validated['email'],
                'ativo' => $validated['ativo']
            ];

            // Checks if password have been changed
            if (isset($validated['password'])) {
                $form_data['password'] = Hash::make($validated['password']);
            }

            $user->fill($form_data);
            $user->save();

            return redirect()->route('cadastros.usuario')->with([
                'store_success' => "Usuario '{$validated['nome']}' atualizado com sucesso!"
            ]);
        }

        //If it's an insert...
        User::create([
            'nome' => $validated['nome'],
            'cpf' => $validated['cpf'],
            'telefone' => $validated['telefone'],
            'email' => $validated['email'],
            'login' => $validated['login'],
            'password' => Hash::make($validated['password']),
            'ativo' => $validated['ativo']
        ]);

        return redirect()->route('cadastros.usuario')->with([
            'store_success' => "Usuario '{$validated['nome']}' cadastrado com sucesso!"
        ]);
    }

    public function search(Request $request)
    {
        $users = User::where('nome', 'like', "%$request->q%")
            ->orwhere('cpf', 'like', "%$request->q%")
            ->orwhere('email', 'like', "%$request->q%")
            ->paginate();

        return view('users.index')->with([
            'users' => $users,
            'search' => $request->q
        ]);
    }

    public function ajax(Request $request, int $id = 0)
    {
        $data = [];

        if ($id) {

            $data = User::select('id', 'nome')
                ->where('id', $id)
                ->where('ativo', true)
                ->first();

            return response()->json($data);
        }

        if (!$request->has('q')) {
            $data = User::select('id', 'nome')->where('ativo', true)->limit(10)->get();
        } else {
            $data = User::select('id', 'nome')
                ->where('nome', 'LIKE', "%$request->q%")
                ->where('ativo', true)
                ->limit(10)
                ->get();
        }

        return response()->json($data);
    }

    public function show(User $user)
    {
        return view('users.form')
            ->with([
                'user' => $user
            ]);
    }

    public function destroy(Request $request)
    {
        $user = User::find($request->user_id);

        if ($user) {
            $nome = $user->nome;
            $user->delete();

            return redirect()->route('cadastros.usuario')->with([
                'delete_success' => "Usuário '$nome' deletado com sucesso!"
            ]);
        }

        return redirect()->route('cadastros.usuario')->with([
            'delete_success' => "Erro inesperado."
        ]);


    }
}
