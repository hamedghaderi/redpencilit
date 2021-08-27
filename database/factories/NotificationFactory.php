<?php

namespace Database\Factories;

use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Notifications\DatabaseNotification;

class NotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DatabaseNotification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
          'type' => 'App\Notifications\TicketCreatedNotification',
          'notifiable_type' => 'App\User',
          'notifiable_id' => function ()  {
              return auth()->user() ? auth()->id(): User::factory()->create()->id;
          },
          'data' => ['foo' => 'bar']
        ];
    }
}
