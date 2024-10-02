<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="CRUD: cuentas y pedidos",
 *     version="1.0.0",
 *     description="Esta API en Laravel permite gestionar usuarios y notas a través de operaciones CRUD (Crear, Leer, Actualizar, Eliminar). Los usuarios pueden registrarse, iniciar sesión y obtener un token de autenticación (utilizando Laravel Sanctum). Los usuarios autenticados pueden crear, ver, actualizar y eliminar notas, las cuales incluyen campos como título, descripción, etiquetas, imagen y fecha de vencimiento."
 * )
*/

class NoteController extends Controller
{
    use AuthorizesRequests;

    /**
     * @OA\Get(
     *     path="/api/notes",
     *     summary="Obtener lista de notas del usuario autenticado",
     *     tags={"Notas"},
     *     @OA\Parameter(
     *         name="orderBy",
     *         in="query",
     *         description="Campo para ordenar las notas",
     *         required=false,
     *         @OA\Schema(type="string", example="created_at")
     *     ),
     *     @OA\Parameter(
     *         name="orderIn",
     *         in="query",
     *         description="Dirección de orden (asc o desc)",
     *         required=false,
     *         @OA\Schema(type="string", example="asc")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Note")
     *         )
     *     )
     * )
     */
    public function index(Request $request){
        $orderBy = $request->query('orderBy', 'created_at');
        $orderIn = $request->query('orderIn', 'asc');
    
        $notes = Note::where('user_id', $request->user()->id)
                    ->orderBy($orderBy, $orderIn)
                    ->get();
    
        return response()->json($notes, 200);
    }

     /**
     * @OA\Post(
     *     path="/api/notes",
     *     summary="Crear una nueva nota",
     *     tags={"Notas"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title","description"},
     *             @OA\Property(property="title", type="string", example="Mi nota"),
     *             @OA\Property(property="description", type="string", example="Descripción de la nota"),
     *             @OA\Property(property="tags", type="string", example="etiqueta1, etiqueta2"),
     *             @OA\Property(property="imagenUrl", type="string", format="url", example="https://ejemplo.com/imagen.jpg"),
     *             @OA\Property(property="expirationDate", type="string", format="date", example="2024-10-01")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Nota creada exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Note")
     *     )
     * )
     */
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

    /**
     * @OA\Get(
     *     path="/api/notes/{id}",
     *     summary="Obtener una nota por su ID",
     *     tags={"Notas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la nota",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Nota encontrada",
     *         @OA\JsonContent(ref="#/components/schemas/Note")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Nota no encontrada"
     *     )
     * )
     */
    public function show(Note $note){
        
        $this->authorize('view', $note);
        return response()->json($note, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/notes/{id}",
     *     summary="Actualizar una nota existente",
     *     tags={"Notas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la nota",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title","description"},
     *             @OA\Property(property="title", type="string", example="Mi nota actualizada"),
     *             @OA\Property(property="description", type="string", example="Descripción actualizada de la nota"),
     *             @OA\Property(property="tags", type="string", example="nuevaEtiqueta1, nuevaEtiqueta2"),
     *             @OA\Property(property="imagenUrl", type="string", format="url", example="https://ejemplo.com/nueva-imagen.jpg"),
     *             @OA\Property(property="expirationDate", type="string", format="date", example="2024-12-01")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Nota actualizada exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Note")
     *     )
     * )
     */
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

    /**
     * @OA\Delete(
     *     path="/api/notes/{id}",
     *     summary="Eliminar una nota existente",
     *     tags={"Notas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la nota",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Nota eliminada exitosamente"
     *     )
     * )
     */
    public function destroy(Note $note){
        $this->authorize('delete', $note);

        $note->delete();

        return response()->json(null, 204);
    }
}
