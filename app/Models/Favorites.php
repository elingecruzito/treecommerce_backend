<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    use HasFactory;

    protected $table = 'favorites';

    public $timestamps = true;

    protected $fillable = [
        'id', 'id_user', 'id_product','value'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted'
    ];

    const VALUE_FAVORITE = 1;
    const VALUE_NOT_FAVORITE = 0;

    public static function setFavorite($token, $product, $value){
      if( User::getAuthenticateToken($token) ){ // Si el token es valido

        $dataUser = User::getDataByToken($token); //Se obtienen los datos del token

        return Favorites::where([
          'id_user' => $dataUser->id,
          'id_product' => $product
        ])->update([
          'value' => $value
        ]);

      }
    }
}
