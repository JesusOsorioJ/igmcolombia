<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Note;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_note()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/notes', [
            'title' => 'Nota de ejemplo',
            'description' => 'Descripción de la nota',
            'tags' => 'importante',
            'imagenUrl' => 'https://ejemplo.com/imagen.jpg',
            'expirationDate' => '2024-12-31',
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'title' => 'Nota de ejemplo',
                     'description' => 'Descripción de la nota',
                     'tags' => 'importante',
                     'imagenUrl' => 'https://ejemplo.com/imagen.jpg',
                     'expirationDate' => '2024-12-31',
                 ]);

        $this->assertDatabaseHas('notes', [
            'title' => 'Nota de ejemplo',
            'user_id' => $user->id,
        ]);
    }

    public function test_get_notes_for_user()
    {
        $user = User::factory()->create();
        Note::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->getJson('/api/notes');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => [
                         'id', 'title', 'description', 'tags', 'imagenUrl', 'expirationDate', 'user_id'
                     ]
                 ]);
    }

    public function test_update_note()
    {
        $user = User::factory()->create();
        $note = Note::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->putJson("/api/notes/{$note->id}", [
            'title' => 'Nota actualizada',
            'description' => 'Descripción actualizada',
            'tags' => 'actualizado',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'title' => 'Nota actualizada',
                     'description' => 'Descripción actualizada',
                     'tags' => 'actualizado',
                 ]);

        $this->assertDatabaseHas('notes', [
            'title' => 'Nota actualizada',
            'id' => $note->id,
        ]);
    }

    public function test_delete_note()
    {
        $user = User::factory()->create();
        $note = Note::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->deleteJson("/api/notes/{$note->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('notes', [
            'id' => $note->id,
        ]);
    }
}
