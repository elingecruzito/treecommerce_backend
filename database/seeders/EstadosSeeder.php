<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $model = new \App\Models\Estados;
        $model->estado = 'Aguascalientes';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Baja California';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Baja California Sur';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Campeche';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Coahuila de Zaragoza';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Colima';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Chiapas';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Chihuahua';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Distrito Federal';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Durango';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Guanajuato';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Guerrero';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Hidalgo';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Jalisco';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'México';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Michoacán de Ocampo';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Morelos';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Nayarit';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Nuevo León';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Oaxaca de Juárez';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Puebla';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Querétaro';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Quintana Roo';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'San Luis Potosí';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Sinaloa';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Sonora';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Tabasco';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Tamaulipas';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Tlaxcala';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Veracruz de Ignacio de la Llave';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Yucatán';
        $model->save();

        $model = new \App\Models\Estados;
        $model->estado = 'Zacatecas';
        $model->save();

    }
}
