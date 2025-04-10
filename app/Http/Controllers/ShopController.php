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
        $validation = Validator([
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

        if($validation->fails()) {
            return response()->json(['message' => 'A validação falhou!'], 500);
        }

        $shop = Shop::create($request->all());
        return response()->json($shop);
    }

    public function show($id)
    {
        $shop = Shop::findOrFail($id);

        if(!$shop) {
            return response()->json(['message' => 'Cafeteria não encontrada']);
        }

        return response()->json($shop);
    }

    public function update(Request $request, $id)
    {
        $shop = Shop::findOrFail($id);

        if(!$shop) {
            return response()->json(['message' => 'Cafeteria não encontrada']);
        }

        $shop->update($request->all());

        return response()->json($shop);
    }

    public function delete($id)
    {
        $shop = Shop::findOrFail($id);

        if(!$shop) {
            return response()->json(['message' => 'Cafeteria não encontrada']);
        }
        
        $shop->delete();

        return response()->json(['message' => 'Cafeteria deletada com sucesso!']);
    }
}
