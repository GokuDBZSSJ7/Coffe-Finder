<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $validation = Validator([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validation->fails()) {
            return response()->json(['message' => 'Falha de validação'], 500);
        }

        $user = User::create($validation);

        return response()->json($user);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        if(!$user) {
            return response()->json(['message' => 'Usuário não encontrado!']);
        }

        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if(!$user) {
            return response()->json(['message' => 'Usuário não encontrado!']);
        }

        $user->update($request->all());
        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if(!$user) {
            return response()->json(['message' => 'Usuário não encontrado!']);
        }

        $user->delete();
        return response()->json(['message' => 'Usuário deletado com sucesso!']);
    }
}
