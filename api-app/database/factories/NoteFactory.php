<?php

namespace Database\Factories;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    protected $model = Note::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'tags' => implode(',', $this->faker->words(3)),
            'imagenUrl' => $this->faker->imageUrl(),
            'expirationDate' => $this->faker->dateTimeBetween('now', '+1 year'),
            'user_id' => User::factory(),
        ];
    }
}
