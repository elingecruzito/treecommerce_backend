<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $_user = new \App\Models\User;
        $_user->name = 'Administrador';
        $_user->email = 'admin@admin.com';
        $_user->email_verified_at = now();
        $_user->remember_token = 'OzHxUoOd9OlBWFEpp4cw';
        $_user->password = Hash::make('59xNLVO0');
        $_user->save();

        \App\Models\User::factory()->count(19)->create();
    }
}
