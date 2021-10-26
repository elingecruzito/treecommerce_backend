<?php

namespace Database\Factories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Products::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => Str::random(100),
            'price' => $this->faker->numberBetween(100, 9999) ,
            'description' => $this->faker->paragraph() ,
            'unity' => $this->faker->numberBetween(1, 100) ,
            'id_provider' => $this->faker->numberBetween(1,20),
            'id_category' => $this->faker->numberBetween(1,20),
            'created_at' => now()->subDays($this->faker->numberBetween(1, 30)),
            'updated_at' => now()->addDays($this->faker->numberBetween(1, 30)),
            'deleted' => 0,
        ];
    }
}
