<?php

namespace Database\Factories;

use App\Models\Valorations;
use Illuminate\Database\Eloquent\Factories\Factory;

class ValorationsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Valorations::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'starts' => $this->faker->numberBetween(0, 5),
            'comment' => $this->faker->paragraph(),
            'id_user' => $this->faker->numberBetween(1,20),
            'id_product' => $this->faker->numberBetween(1,100),
            'deleted' => 0,
        ];
    }
}
