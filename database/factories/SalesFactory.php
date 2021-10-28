<?php

namespace Database\Factories;

use App\Models\Sales;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sales::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'id_user' => $this->faker->numberBetween(1, 20),
            'id_status' => $this->faker->numberBetween(1, 5),
            'id_direction' => $this->faker->numberBetween(1, 20),
            'id_product' => $this->faker->numberBetween(1, 100),
            'count' => $this->faker->numberBetween(1, 50),
            'cost' => function (array $attributes) {
                return \App\Models\Products::where('id', $attributes['id_product'])
                                ->first()->price;
            },
            'total' => function (array $attributes) {

                return $attributes['cost'] * $attributes['count'];
            },
            'created_at' => now()->subDays($this->faker->numberBetween(1, 30)),
            'updated_at' => now()->addDays($this->faker->numberBetween(1, 30)),
            'deleted' => 0,
        ];
    }
}
