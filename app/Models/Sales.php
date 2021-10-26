<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'sales';

    public $timestamps = true;

    protected $fillable = [
        'id', 'id_user', 'id_status', 'id_direction', 'total'. 'created_at'
    ];

    protected $hidden = [
        'updated_at',
        'deleted'
    ];

    public static function add($token, $direction, $product, $count){
      if( User::getAuthenticateToken($token) ){ // Si el token es valido

        $dataUser = User::getDataByToken($token); //Se obtienen los datos del token
        $productModel = Products::where('id', $product)->first();

        //Se optiene el ultimo producto visto
        return Sales::create([
          'id_user' => $dataUser->id,
          'id_status' => 1,
          'id_direction' => $direction,
          'total' => ($productModel->price * $count ),
          'deleted' => 0
        ]);
      }

      return null;
    }
}
