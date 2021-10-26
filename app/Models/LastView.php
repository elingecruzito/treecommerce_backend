<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class LastView extends Model
{
    use HasFactory;

    protected $table = 'last_views';

    public $timestamps = true;

    protected $fillable = [
        'id', 'id_user', 'id_product'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted'
    ];

    private static function getOriginalQuery(){
      return LastView::where([
                              'last_views.deleted' => Utils::VALUE_ACTIVED
                          ])
                          ->join('products', function ($join) {
                            $join->on('products.id', '=', 'last_views.id_product')
                            ->where('products.deleted', Utils::VALUE_ACTIVED);
                          })
                          ->join('categories', function ($join) {
                            $join->on('categories.id', '=', 'products.id_category');
                          })
                          ->join('providers', function ($join) {
                            $join->on('providers.id', '=', 'products.id_provider');
                          })
                          ->leftJoin('offers', function ($join) {
                            $join->on('offers.id_product', '=', 'last_views.id_product')
                            ->where('offers.deleted', Utils::VALUE_ACTIVED);
                          })
                          ->leftJoin('valorations', function ($join) {
                            $join->on('valorations.id_product', '=', 'last_views.id_product')
                            ->where('valorations.deleted', Utils::VALUE_ACTIVED);
                          })
                          ->leftJoin('favorites', function ($join) {
                            $join->on('favorites.id_product', '=', 'last_views.id_product')
                            ->where('favorites.deleted', Utils::VALUE_ACTIVED);
                          })
                          ->select(
                            'products.id',
                            'products.name',
                            'products.price',
                            'products.description',
                            'products.unity',
                            'categories.category',
                            'products.id_category',
                            'providers.name AS provider',
                          )
                          ->selectRaw('IF( AVG(tree_valorations.`starts`) is null, 0, AVG(tree_valorations.`starts`)) AS valoration')
                          ->selectRaw('COUNT(tree_valorations.id) AS count_valoration')
                          ->selectRaw('IF( COUNT(tree_favorites.id) > 0, 1, 0) AS favorite')
                          ->selectRaw('IF( tree_offers.percentage is null, 0, tree_offers.percentage) AS percentage')
                          ->orderByRaw('tree_last_views.created_at DESC');
    }

    public static function getLast($token){

      if( User::getAuthenticateToken($token) ){ // Si el token es valido

        $dataUser = User::getDataByToken($token); //Se obtienen los datos del token

        //Se optiene el ultimo producto visto
        return LastView::getOriginalQuery()
                        ->where([
                          'last_views.id_user' => $dataUser->id
                        ])
                        ->first();
      }

      return null;

    }

    public static function shortHistory($token){

      if( User::getAuthenticateToken($token) ){ // Si el token es valido

        $dataUser = User::getDataByToken($token); //Se obtienen los datos del token

        //Se optienen los ultimos 3 productos vistos
        return LastView::getOriginalQuery()
                        ->where([
                          'last_views.id_user' => $dataUser->id
                        ])
                        ->limit(3)
                        ->groupBy('last_views.id_product')
                        ->get();
      }

      return null;

    }

    public static function completeList($token){
      if( User::getAuthenticateToken($token) ){ // Si el token es valido
        $dataUser = User::getDataByToken($token); //Se obtienen los datos del token
        return LastView::getOriginalQuery()
                        ->where([
                          'last_views.id_user' => $dataUser->id
                        ])
                        ->groupBy('last_views.id_product')
                        ->get();
      }
    }

    public static function add($token, $id){
      if( User::getAuthenticateToken($token) ){ // Si el token es valido
        $dataUser = User::getDataByToken($token); //Se obtienen los datos del token
        LastView::create([
          'id_user' => $dataUser->id,
          'id_product' => (int)$id,
          'deleted' => 0
        ]);

        return LastView::getLast($token);
      }
    }

}
