<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request){
        $orderBy = $request->query('orderBy', 'created_at');
        $orderIn = $request->query('orderIn', 'asc');
    
        $notes = Note::where('user_id', $request->user()->id)
                    ->orderBy($orderBy, $orderIn)
                    ->get();
    
        return response()->json($notes, 200);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tags' => 'nullable|string',
            'imagenUrl' => 'nullable|url',
            'expirationDate' => 'nullable|date',
        ]);

        $note = new Note($validated);
        $note->user_id = $request->user()->id;
        $note->save();

        return response()->json($note, 201);
    }

    public function show(Note $note){
        
        $this->authorize('view', $note);
        return response()->json($note, 200);
    }

    public function update(Request $request, Note $note){
        $this->authorize('update', $note);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tags' => 'nullable|string',
            'imagenUrl' => 'nullable|url',
            'expirationDate' => 'nullable|date',
        ]);

        $note->update($validated);

        return response()->json($note, 200);
    }

    public function destroy(Note $note){
        $this->authorize('delete', $note);

        $note->delete();

        return response()->json(null, 204);
    }
}
