<?php

namespace Database\Factories;

use App\Models\RelationSales;
use Illuminate\Database\Eloquent\Factories\Factory;

class RelationSalesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RelationSales::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'id_product' => $this->faker->numberBetween(1, 100),
            'id_sale' => $this->faker->numberBetween(1, 50),
            'count' => $this->faker->numberBetween(1, 50),
            'cost' => $this->faker->numberBetween(1, 999),
        ];
    }
}
