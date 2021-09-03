<?php

namespace Database\Factories;

use App\Models\Directions;
use Illuminate\Database\Eloquent\Factories\Factory;

class DirectionsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Directions::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'id_user' => $this->faker->numberBetween(1,20),
            'state' => $this->faker->numberBetween(1,50),
            'country' => $this->faker->numberBetween(1,50),
            'address' => $this->faker->paragraph(),
            'cp' => $this->faker->numberBetween(20000,99999),
            'phone' => $this->faker->numerify('###-###-##-##'),
            'person' => $this->faker->name(),
            'deleted' => 0,
        ];
    }
}
