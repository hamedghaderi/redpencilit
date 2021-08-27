<?php

namespace Database\Factories;

use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'owner_id' => User::factory()->create()->id,
          'excerpt' => $this->faker->paragraph(1),
          'title' => $this->faker->words(5),
          'body' => $this->faker->paragraphs(4)
        ];
    }
}
