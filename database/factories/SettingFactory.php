<?php

namespace Database\Factories;

use App\Setting;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'upload_articles_per_day' => $this->faker->numberBetween(1, 4),
          'upload_words_per_day' => $this->faker->numberBetween(15000, 20000),
          'price_per_word' => $this->faker->numberBetween(10, 100),
          'base_price_for_docs' => $this->faker->numberBetween(50000, 100000),
          'owner_id' => User::factory()->create()->id
        ];
    }
}
