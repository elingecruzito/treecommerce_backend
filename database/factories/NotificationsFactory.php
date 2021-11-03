<?php

namespace Database\Factories;

use App\Models\Notifications;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notifications::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
              'id_user' => $this->faker->numberBetween(1, 20),
              'type' => $this->faker->numberBetween(1, 5),
              'title' => $this->faker->name(),
              'message' => $this->faker->paragraph() ,
              'readed' => $this->faker->numberBetween(0, 1),
              'created_at' => now()->subDays($this->faker->numberBetween(1, 30)),
              'updated_at' => now()->addDays($this->faker->numberBetween(1, 30)),
              'deleted' => $this->faker->numberBetween(0, 1),
        ];
    }
}
