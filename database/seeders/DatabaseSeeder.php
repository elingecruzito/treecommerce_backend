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
     * @return void
     */
    public function run()
    {
        $_user = new \App\Models\User;
        $_user->name = 'Administrador';
        $_user->email = 'andmin@admin.com';
        $_user->email_verified_at = now();
        $_user->password = Hash::make('59xNLVO0');

        $_user->save();


    }
}
