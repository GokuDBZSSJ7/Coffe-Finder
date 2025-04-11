<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    public function index()
    {
        return Shop::all();
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'user_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'city' => 'required',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'opening_hours' => 'nullable',
            'image_url' => 'nullable'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message' => 'Erro de validação!',
                'errors' => $validation->errors()
            ], 422);
        }

        $shop = Shop::create($request->all());
        return response()->json([
            'message' => 'Cafeteria criada com sucesso!',
            'shop' => $shop
        ], 200);
    }

    public function show($id)
    {
        $shop = Shop::findOrFail($id);

        if(!$shop) {
            return response()->json(['message' => 'Cafeteria não encontrada'], 404);
        }

        return response()->json($shop);
    }

    public function update(Request $request, $id)
    {
        $shop = Shop::findOrFail($id);

        if(!$shop) {
            return response()->json(['message' => 'Cafeteria não encontrada'], 404);
        }

        $shop->update($request->all());

        return response()->json([
            'message' => 'Cafeteria atualizado com sucesso!',
            'shop' => $shop
        ], 200);
    }

    public function delete($id)
    {
        $shop = Shop::findOrFail($id);

        if(!$shop) {
            return response()->json(['message' => 'Cafeteria não encontrada'], 404);
        }
        
        $shop->delete();

        return response()->json(['message' => 'Cafeteria deletada com sucesso!'], 200);
    }
}
