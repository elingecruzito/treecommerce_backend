<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Favorites;

class FavoritesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $users = DB::table('users')->get();
      $products = DB::table('products')->get();

      foreach ($users as $keyUser => $valueUser) {
        foreach ($products as $keyProd => $valueProd) {
          Favorites::create([
            'id_user' => $valueUser->id,
            'id_product' => $valueProd->id,
            'value' => rand(0 , 1),
            'deleted' => 0,
          ]);
        }
      }

    }
}
