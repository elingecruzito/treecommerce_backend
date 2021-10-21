<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directions extends Model
{
    use HasFactory;

    protected $table = 'directions';

    protected $hidden = [
        'id_user',
        'created_at',
        'updated_at',
        'deleted'
    ];

    public static function getListDirections($token){
      if( User::getAuthenticateToken($token) ){ // Si el token es valido

        $dataUser = User::getDataByToken($token); //Se obtienen los datos del token

        return Directions::where([
            'directions.deleted' => Utils::VALUE_ACTIVED,
            'directions.id_user' => $dataUser->id
        ])
        ->join('estados', function ($join) {
          $join->on('estados.id', '=', 'directions.state');
        })
        ->join('municipios', function ($join) {
          $join->on('municipios.id', '=', 'directions.country');
        })
        ->select(
          'directions.id',
          'estados.estado AS state',
          'municipios.municipio AS country',
          'directions.address',
          'directions.cp',
          'directions.phone',
          'directions.person'
        )
        ->get();

      }
    }
}
