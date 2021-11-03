<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    public $timestamps = true;

    protected $fillable = [
        'id', 'type', 'title', 'message', 'readed', 'created_at'
    ];

    protected $hidden = [
        'id_user',
        'updated_at',
        'deleted'
    ];

    CONST NOTIFICATION_COMPRA = 1;
    CONST NOTIFICATION_ENVIADO = 2;
    CONST NOTIFICATION_ENTREGADO = 3;
    CONST NOTIFICATION_CANCELADO = 4;
    CONST NOTIFICATION_DEVUELTO = 5;

    CONST NOTIFICATION_OPEN = 0;
    CONST NOTIFICATION_READED = 1;

    public static function listNotifications($token){
      if( User::getAuthenticateToken($token) ){ // Si el token es valido

        $dataUser = User::getDataByToken($token); //Se obtienen los datos del token

        return Notifications::where('id_user', $dataUser->id )
                      ->where('deleted', Utils::VALUE_ACTIVED)
                      ->orderByRaw('created_at DESC')
                      ->limit(10)
                      ->get();

      }

      return null;
    }
}
