<?php

namespace Database\Factories;

use App\Comment;
use App\Testimonial;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Testimonial::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'body' => $this->faker->paragraph(2),
          'author_id' => User::factory()->create()->id,
          'comment_id' => Comment::factory()->create()->id,
        ];
    }
}
