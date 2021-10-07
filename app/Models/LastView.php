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
        return LastView::where(['last_views.id_user' => $dataUser->id, 'last_views.deleted' => Utils::VALUE_ACTIVED ])
                            ->orderByRaw('tree_last_views.created_at DESC')
                            ->join('products', function ($join) {
                              $join->on('products.id', '=', 'last_views.id_product')
                              ->where('products.deleted', Utils::VALUE_ACTIVED);
                            })
                            ->join('categories', function ($join) {
                              $join->on('categories.id', '=', 'products.id_category');
                            })
                            ->leftJoin('galery', function ($join) {
                              $join->on('galery.id_product', '=', 'products.id')
                              ->where('galery.deleted', Utils::VALUE_ACTIVED)
                              ->orderByRaw('galery.created_at DESC');
                            })
                            ->leftJoin('offers', function ($join) {
                              $join->on('offers.id_product', '=', 'products.id')
                              ->where('offers.deleted', Utils::VALUE_ACTIVED)
                              ->orderByRaw('offers.created_at DESC');
                            })
                            ->select(
                              'products.id',
                              'products.name',
                              'products.price',
                              'products.description',
                              'products.unity',
                              'categories.category',
                              'products.id_category',
                              'galery.path'
                            )
                            ->selectRaw('IF( tree_offers.percentage is null, 0, tree_offers.percentage) AS percentage')
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
                            ->join('categories', function ($join) {
                              $join->on('categories.id', '=', 'products.id_category');
                            })
                            ->leftJoin('galery', function ($join) {
                              $join->on('galery.id_product', '=', 'products.id')
                              ->where('galery.deleted', Utils::VALUE_ACTIVED)
                              ->orderByRaw('galery.created_at DESC');
                            })
                            ->leftJoin('offers', function ($join) {
                              $join->on('offers.id_product', '=', 'products.id')
                              ->where('offers.deleted', Utils::VALUE_ACTIVED)
                              ->orderByRaw('offers.created_at DESC');
                            })
                            ->limit(3)
                            ->groupBy('last_views.id_product')
                            ->select(
                              'products.id',
                              'products.name',
                              'products.price',
                              'products.description',
                              'products.unity',
                              'categories.category',
                              'galery.path',
                              // 'offers.percentage'
                            )
                            ->selectRaw('IF( tree_offers.percentage is null, 0, tree_offers.percentage) AS percentage')
                            ->get();

      }

      return null;

    }

    public static function completeList($token){
      if( User::getAuthenticateToken($token) ){ // Si el token es valido
        $dataUser = User::getDataByToken($token); //Se obtienen los datos del token

        return LastView::where(['last_views.id_user' => $dataUser->id, 'last_views.deleted' => Utils::VALUE_ACTIVED ])
                            ->orderByRaw('tree_last_views.created_at DESC')
                            ->join('products', function ($join) {
                              $join->on('products.id', '=', 'last_views.id_product')
                              ->where('products.deleted', Utils::VALUE_ACTIVED);
                            })
                            ->join('categories', function ($join) {
                              $join->on('categories.id', '=', 'products.id_category');
                            })
                            ->leftJoin('favorites', function ($join) {
                              $join->on('favorites.id_product', '=', 'products.id')
                              ->where('favorites.deleted', Utils::VALUE_ACTIVED);
                            })
                            ->leftJoin('galery', function ($join) {
                              $join->on('galery.id_product', '=', 'products.id')
                              ->where('galery.deleted', Utils::VALUE_ACTIVED)
                              ->orderByRaw('galery.created_at DESC');
                            })
                            ->leftJoin('offers', function ($join) {
                              $join->on('offers.id_product', '=', 'products.id')
                              ->where('offers.deleted', Utils::VALUE_ACTIVED)
                              ->orderByRaw('offers.created_at DESC');
                            })
                            ->select(
                              'products.id',
                              'products.name',
                              'products.price',
                              'products.description',
                              'products.unity',
                              'categories.category',
                              'galery.path',
                              // 'offers.percentage'
                              // 'favorites.id'
                            )
                            ->selectRaw('IF( COUNT(tree_favorites.id) > 0, true, false) AS favorite')
                            ->selectRaw('IF( tree_offers.percentage is null, 0, tree_offers.percentage) AS percentage')
                            ->groupBy('last_views.id_product')
                            ->get();
      }
    }

}
