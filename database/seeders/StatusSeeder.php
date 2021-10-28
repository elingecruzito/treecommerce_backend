<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new \App\Models\Status;
        $model->status = 'Comprado';
        $model->save();

        $model = new \App\Models\Status;
        $model->status = 'Preparando';
        $model->save();

        $model = new \App\Models\Status;
        $model->status = 'En camino';
        $model->save();

        $model = new \App\Models\Status;
        $model->status = 'Entregado';
        $model->save();

        $model = new \App\Models\Status;
        $model->status = 'Cancelado';
        $model->save();
    }
}
