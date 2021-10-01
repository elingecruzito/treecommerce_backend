<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    use HasFactory;

    protected $table = 'offers';

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted'
    ];

    public static function getLastOffers($token){
      if( User::getAuthenticateToken($token) ){ // Si el token es valido

        $dataUser = User::getDataByToken($token); //Se obtienen los datos del token

        return Offers::where('deleted', Utils::VALUE_ACTIVED)
                      ->orderByRaw('created_at DESC')
                      ->limit(3)
                      ->get();

      }

      return null;
    }
}
