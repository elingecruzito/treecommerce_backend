<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelacionEstadosMunicipios extends Model
{
    use HasFactory;

    protected $table = 'relacion_estados_municipios';

    public static function relation(){
      return RelacionEstadosMunicipios::where([
                                      'relacion_estados_municipios.deleted' => Utils::VALUE_ACTIVED,
                                    ])
                                    ->join('estados', function ($join) {
                                      $join->on('estados.id', '=', 'relacion_estados_municipios.id_estado');
                                    })
                                    ->join('municipios', function ($join) {
                                      $join->on('municipios.id', '=', 'relacion_estados_municipios.id_municipio');
                                    });
    }

    public static function getRangeCountry($state){
      return RelacionEstadosMunicipios::relation()
                                      ->where([
                                        'relacion_estados_municipios.id_estado' => $state,
                                      ])
                                      ->selectRaw('MIN(tree_relacion_estados_municipios.id_municipio) as inicio')
                                      ->selectRaw('MAX(tree_relacion_estados_municipios.id_municipio) as fin')
                                      ->first();
    }
}