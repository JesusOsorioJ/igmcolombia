<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     required={"name", "email", "password"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID del usuario",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Nombre del usuario",
 *         example="John Doe"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         format="email",
 *         description="Correo electrónico del usuario",
 *         example="john.doe@example.com"
 *     ),
 *     @OA\Property(
 *         property="password",
 *         type="string",
 *         format="password",
 *         description="Contraseña del usuario",
 *         example="password123"
 *     ),
 *     @OA\Property(
 *         property="email_verified_at",
 *         type="string",
 *         format="date-time",
 *         description="Fecha de verificación del correo electrónico",
 *         example="2024-10-01T12:34:56Z"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Fecha de creación del usuario",
 *         example="2024-10-01T12:34:56Z"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Fecha de actualización del usuario",
 *         example="2024-10-01T13:45:12Z"
 *     )
 * )
 */

 /**
 * @OA\Schema(
 *     schema="NoteWithUser",
 *     allOf={
 *         @OA\Schema(ref="#/components/schemas/Note"),
 *         @OA\Schema(
 *             @OA\Property(
 *                 property="user",
 *                 ref="#/components/schemas/User"
 *             )
 *         )
 *     }
 * )
 */


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}

