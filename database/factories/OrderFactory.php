<?php

namespace Database\Factories;

use App\Order;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'owner_id' => User::factory()->create()->id,
          'total_words' => 300,
          'delivery_date' => \Carbon\Carbon::createFromTime('12', '0', '0', 'Asia/Tehran')->addWeek()->addDay(),
          'orders_count' => 4,
          'price' => $this->faker->numberBetween(0, 10000000)
        ];
    }
}
