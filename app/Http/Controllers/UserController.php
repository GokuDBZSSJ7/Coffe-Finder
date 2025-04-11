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
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message' => 'Erro de validação!',
                'errors' => $validation->errors()
            ], 422);
        }

        $user = User::create($request->all());

        return response()->json([
            'message' => 'Usuário criado com sucesso!',
            'user' => $user
        ], 200);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        if(!$user) {
            return response()->json(['message' => 'Usuário não encontrado!'], 404);
        }

        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if(!$user) {
            return response()->json(['message' => 'Usuário não encontrado!'], 404);
        }

        $user->update($request->all());
        return response()->json([
            'message' => 'Usuário atualizado com sucesso!',
            'user' => $user
        ], 200);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if(!$user) {
            return response()->json(['message' => 'Usuário não encontrado!'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'Usuário deletado com sucesso!'], 200);
    }
}
