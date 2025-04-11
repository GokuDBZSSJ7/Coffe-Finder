<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'shop_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message' => 'Erro de validação!',
                'errors' => $validation->errors()
            ], 422);
        }

        $product = Product::create($request->all());
        return response()->json([
            'message' => 'Produto criado com sucesso!',
            'product' => $product
        ], 200);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        if(!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if(!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        $product->update($request->all());
        return response()->json([
            'message' => 'Produto atualizado com sucesso!',
            'product' => $product
        ], 200);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if(!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Produto Deletado com Sucesso'], 200);
    }
}
