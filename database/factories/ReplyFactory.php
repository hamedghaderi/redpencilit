<?php

namespace Database\Factories;

use App\Reply;
use App\Ticket;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'ticket_id' => Ticket::factory()->create()->id,
          'owner_id' => User::factory()->create()->id,
          'body' => $this->faker->paragraph(2)
        ];
    }
}
