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

    private static $index = 0;

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
            'id_status' => $this->faker->numberBetween(1, 20),
            'id_direction' => $this->faker->numberBetween(1, 20),
            'total' => function (array $attributes) {

                self::$index++;

                return \App\Models\RelationSales::where('id_sale', self::$index)
                              ->selectRaw('SUM((tree_relation_sales.cost) * (tree_relation_sales.count)) AS suma')
                              ->first()->suma;
            },
            'created_at' => now()->subDays($this->faker->numberBetween(1, 30)),
            'updated_at' => now()->addDays($this->faker->numberBetween(1, 30)),
            'deleted' => 0,
        ];
    }
}
