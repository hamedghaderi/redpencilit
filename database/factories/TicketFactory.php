<?php

namespace Database\Factories;

use App\Ticket;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'title' => $this->faker->words(5),
          'body' => $this->faker->paragraph(2),
          'owner_id' => User::factory()->create()->id,
          'attachment' => $file = \Illuminate\Http\UploadedFile::fake()->create('test.jpg')->hashName()
        ];
    }
}
