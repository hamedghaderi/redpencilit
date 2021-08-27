<?php

namespace Database\Factories;

use App\Order;
use App\OrderDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'order_id' => Order::factory()->create()->id,
          'path' => $this->faker->name,
          'name' => $this->faker->name,
          'words' => $this->faker->numberBetween(0, 20000)
        ];
    }
}
