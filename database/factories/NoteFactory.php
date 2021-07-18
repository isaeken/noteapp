<?php

namespace Database\Factories;

use App\Actions\Encryption\Encryption;
use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Note::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'pinned' => $this->faker->boolean(5),
            'order' => $this->faker->boolean(5) ? $this->faker->numberBetween(0, 20) : null,
            'color' => $this->faker->boolean(5) ? $this->faker->hexColor : null,
            'title' => Encryption::encrypt($this->faker->text(20)),
            'message' => Encryption::encrypt($this->faker->text),
        ];
    }
}
