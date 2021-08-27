<?php

namespace Database\Factories;

use App\Document;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Document::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'path' => $this->faker->name,
          'owner_id' => User::factory()->create()->id,
          'draft' => $this->faker->boolean(),
          'words' => $this->faker->numberBetween(0, 1000),
          'recent' => $this->faker->boolean(),
          'code' => uniqid()
        ];
    }
}
