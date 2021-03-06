<?php

namespace Database\Factories;

use App\Models\Galery;
use Illuminate\Database\Eloquent\Factories\Factory;

class GaleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Galery::class;

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
            'path' => 'https://coca-colafemsa.com/wp-content/uploads/2019/11/2.png',
            'created_at' => now()->subDays($this->faker->numberBetween(1, 30)),
            'updated_at' => now()->addDays($this->faker->numberBetween(1, 30)),
            'deleted' => $this->faker->numberBetween(0, 1),
        ];
    }
}
