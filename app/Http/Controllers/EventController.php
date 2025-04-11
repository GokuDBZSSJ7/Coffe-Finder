<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index()
    {
        return Event::all();
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "shop_id" => "required",
            "title" => "required",
            "description" => "required",
            "event_date" => "required"
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message' => 'Erro de validação!',
                'errors' => $validation->errors()
            ], 422);
        }

        $event = Event::create($request->all());
        return response()->json([
            'message' => 'Evento criado com sucesso!',
            'event' => $event
        ], 200);
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        
        if(!$event) {
            return response()->json(['message' => 'Evento não encontrado!'], 404);
        }

        return response()->json($event);
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        
        if(!$event) {
            return response()->json(['message' => 'Evento não encontrado!'], 404);
        }

        $event->update($request->all());
        return response()->json([
            'message' => 'Evento atualizado com sucesso!',
            'event' => $event
        ], 200);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        
        if(!$event) {
            return response()->json(['message' => 'Evento não encontrado!'], 404);
        }

        $event->delete();
        return response()->json(['message' => 'Evento deletado com sucesso!'], 200);
    }
}
