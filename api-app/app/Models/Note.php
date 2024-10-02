<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @OA\Schema(
 *     schema="Note",
 *     type="object",
 *     required={"title", "description", "user_id"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID de la nota",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         description="Título de la nota",
 *         example="Mi nota"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         description="Descripción de la nota",
 *         example="Esta es la descripción de mi nota"
 *     ),
 *     @OA\Property(
 *         property="tags",
 *         type="string",
 *         description="Etiquetas asociadas a la nota",
 *         example="importante, personal"
 *     ),
 *     @OA\Property(
 *         property="imagenUrl",
 *         type="string",
 *         format="url",
 *         description="URL de la imagen asociada a la nota",
 *         example="https://ejemplo.com/imagen.jpg"
 *     ),
 *     @OA\Property(
 *         property="expirationDate",
 *         type="string",
 *         format="date",
 *         description="Fecha de expiración de la nota",
 *         example="2024-12-31"
 *     ),
 *     @OA\Property(
 *         property="user_id",
 *         type="integer",
 *         description="ID del usuario al que pertenece la nota",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Fecha de creación de la nota",
 *         example="2024-10-01T12:34:56Z"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Fecha de actualización de la nota",
 *         example="2024-10-01T13:45:12Z"
 *     )
 * )
 */

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'tags',
        'imagenUrl',
        'expirationDate',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
