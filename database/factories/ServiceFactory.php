<?php

namespace Database\Factories;

use App\Service;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'name' => [
            'fa'  => 'Farsi Resume',
            'en' => 'Resume'
          ],
          'negotiable' => false,
          'user_id' => User::factory()->create()->id
        ];
    }
}
