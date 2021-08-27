<?php

namespace Database\Factories;

use App\CollegeDegree;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollegeDegreeFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CollegeDegree::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'name' => json_encode(['fa' => 'کارشناسی', 'en' => 'Bachelors'])
        ];
    }
}
