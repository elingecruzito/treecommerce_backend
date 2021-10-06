<?php

namespace Database\Factories;

use App\Models\Favorites;
use Illuminate\Database\Eloquent\Factories\Factory;

class FavoritesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Favorites::class;

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
            'id_product' => $this->faker->numberBetween(1,100),
            'created_at' => now()->subDays($this->faker->numberBetween(1, 30)),
            'updated_at' => now()->addDays($this->faker->numberBetween(1, 30)),
            'deleted' => $this->faker->numberBetween(0, 1),
        ];
    }
}
