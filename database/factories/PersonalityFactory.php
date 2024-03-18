<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Personality;

class PersonalityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Personality::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'birthdate' => $this->faker->date(),
            'deathdate' => $this->faker->date(),
            'description' => $this->faker->text(),
            'image' => $this->faker->word(),
            'created_by' => $this->faker->randomNumber(),
        ];
    }
}
