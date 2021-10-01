<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class LastView extends Model
{
    use HasFactory;

    protected $table = 'last_views';

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted'
    ];

    public static function getLast($token){

      if( User::getAuthenticateToken($token) ){ // Si el token es valido

        $dataUser = User::getDataByToken($token); //Se obtienen los datos del token

        //Se optiene el ultimo producto visto
        return LastView::where(['id_user' => $dataUser->id, 'last_views.deleted' => Utils::VALUE_ACTIVED ])
                            ->orderByRaw('tree_last_views.created_at DESC')
                            ->join('products', function ($join) {
                              $join->on('products.id', '=', 'last_views.id_product')
                              ->where('products.deleted', Utils::VALUE_ACTIVED);
                            })
                            ->first();

      }

      return null;

    }

    public static function shortHistory($token){

      if( User::getAuthenticateToken($token) ){ // Si el token es valido

        $dataUser = User::getDataByToken($token); //Se obtienen los datos del token

        //Se optienen los ultimos 3 productos vistos
        return LastView::where(['id_user' => $dataUser->id, 'last_views.deleted' => Utils::VALUE_ACTIVED ])
                            ->orderByRaw('tree_last_views.created_at DESC')
                            ->join('products', function ($join) {
                              $join->on('products.id', '=', 'last_views.id_product')
                              ->where('products.deleted', Utils::VALUE_ACTIVED);
                            })
                            ->limit(3)
                            ->get();

      }

      return null;

    }

}
