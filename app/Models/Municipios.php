<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipios extends Model
{
    use HasFactory;

    protected $table = 'municipios';

    public $timestamps = true;

    protected $fillable = [
        'id', 'municipio'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted'
    ];

    public static function getCountry($token, $id_estado){

      if( User::getAuthenticateToken($token) ){ // Si el token es valido
        return RelacionEstadosMunicipios::where([
                                          'relacion_estados_municipios.deleted' => Utils::VALUE_ACTIVED,
                                          'relacion_estados_municipios.id_estado' => $id_estado
                                        ])
                                        ->join('municipios', function ($join) {
                                          $join->on('municipios.id', '=', 'relacion_estados_municipios.id_municipio');
                                        })
                                        ->select(
                                          'relacion_estados_municipios.id_municipio',
                                          'municipios.municipio'
                                        )
                                        ->get();
      }

      return null;

    }

}
