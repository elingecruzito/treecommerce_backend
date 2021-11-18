<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directions extends Model
{
    use HasFactory;

    protected $table = 'directions';

    public $timestamps = true;

    protected $fillable = [
        'id', 'state', 'country', 'address', 'cp', 'phone', 'person'
    ];

    protected $hidden = [
        'id_user',
        'created_at',
        'updated_at',
        'deleted'
    ];

    /*
      {
        'id' => int,
        'state' => String,
        'country' => String,
        'address' => String,
        'cp' => int,
        'phone' => String,
        'person' => String
      }
    */
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

      return null;
    }

    public static function add($token, $state, $country, $address, $cp, $phone, $person){
      if( User::getAuthenticateToken($token) ){ // Si el token es valido
          $dataUser = User::getDataByToken($token); //Se obtienen los datos del token
          $data = Directions::create([
            'id_user' => $dataUser->id,
            'state' => $state,
            'country' => $country,
            'address' => $address,
            'cp' => $cp,
            'phone' => $phone,
            'person' => $person,
            'deleted' => Utils::VALUE_ACTIVED
          ]);

          return $data;
      }

      return null;
    }
}
