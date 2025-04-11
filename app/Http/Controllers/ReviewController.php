<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function index()
    {
        return Review::all();
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "user_id" => "required",
            "shop_id" => "required",
            "rating" => "required",
            "comment" => "nullable"
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message' => 'Erro de validação!',
                'errors' => $validation->errors()
            ], 422);
        }

        $review = Review::create($request->all());
        return response()->json([
            'message' => 'Review criada com sucesso!',
            'review' => $review
        ], 200);
    }

    public function show($id)
    {
        $review = Review::findOrFail($id);

        if(!$review) {
            return response()->json(['message' => 'Review não encontrado!'], 404);
        }

        return response()->json($review);
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        if(!$review) {
            return response()->json(['message' => 'Review não encontrado!'], 404);
        }

        $review->update($request->all());
        return response()->json([
           'message' => 'Review atualizada com sucesso!',
           'review' => $review 
        ], 200);
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        if(!$review) {
            return response()->json(['message' => 'Review não encontrado!'], 404);
        }

        $review->delete();
        return response()->json(['message' => 'Review deletado com sucesso'], 200);
    }
}
