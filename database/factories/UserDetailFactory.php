<?php

namespace Database\Factories;

use App\CollegeDegree;
use App\Country;
use App\User;
use App\UserDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserDetailFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'user_id' => User::factory()->create()->id,
          'college' => 'Stanford University',
          'field' => 'Software Engineering',
          'degree_id' => CollegeDegree::factory()->create()->id,
          'country_id' => Country::factory()->create()->id,
          'address' => $this->faker->address,
          'gender' => true
        ];
    }
}
