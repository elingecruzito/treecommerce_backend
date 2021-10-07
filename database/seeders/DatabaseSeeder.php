<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * php artisan make:migration create_directions_table && php artisan make:model Directions -f
     *
     * @return void
     */
    public function run()
    {
        $_user = new \App\Models\User;
        $_user->name = 'Administrador';
        $_user->email = 'admin@admin.com';
        $_user->email_verified_at = now();
        $_user->remember_token = 'OzHxUoOd9OlBWFEpp4cw';
        $_user->password = Hash::make('59xNLVO0');

        $_user->save();

        \App\Models\User::factory()->count(19)->create();

        \App\Models\Categories::factory()->count(20)->create();
        \App\Models\Status::factory()->count(20)->create();
        \App\Models\Products::factory()->count(100)->create();
        \App\Models\Galery::factory()->count(1000)->create();
        \App\Models\Providers::factory()->count(20)->create();
        \App\Models\Valorations::factory()->count(1000)->create();
        \App\Models\Sales::factory()->count(50)->create();
        \App\Models\RelationSales::factory()->count(1000)->create();
        \App\Models\Directions::factory()->count(999)->create();
        \App\Models\LastView::factory()->count(999)->create();
        \App\Models\Offers::factory()->count(999)->create();
        \App\Models\Favorites::factory()->count(50)->create();
        /**
        * $this->call([
        *     CategoriesSeeder::class,
        * ]);
        */

    }
}
