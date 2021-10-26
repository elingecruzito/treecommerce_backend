<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    use HasFactory;

    protected $table = 'offers';

    public $timestamps = true;

    protected $fillable = [
        'id', 'id_product', 'percentage'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted'
    ];

    /*
      {
        'id' => int,
        'name' => String,
        'price' => int,
        'description' => String,
        'unity' => int,
        'category' => String,
        'id_category' =>int ,
        'provider' => String,
        'valoration' => double,
        'count_valoration' => int,
        'favorite' => int,
        'percentage' => int,
      }
    */
    private static function getOriginalQuery(){

      return Offers::where('offers.deleted', Utils::VALUE_ACTIVED)
                    ->orderByRaw('tree_offers.created_at DESC')
                    ->join('products', function ($join) {
                      $join->on('products.id', '=', 'offers.id_product')
                      ->where('products.deleted', Utils::VALUE_ACTIVED);
                    })
                    ->join('categories', function ($join) {
                      $join->on('categories.id', '=', 'products.id_category');
                    })
                    ->join('providers', function ($join) {
                      $join->on('products.id_provider', '=', 'providers.id');
                    })
                    ->leftJoin('valorations', function ($join) {
                      $join->on('products.id', '=', 'valorations.id_product')
                      ->where('valorations.deleted', Utils::VALUE_ACTIVED);
                    })
                    ->join('favorites', function ($join) {
                      $join->on('products.id', '=', 'favorites.id_product')
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
                    ->groupBy('offers.id_product');
    }

    public static function getLastOffers($token){
      if( User::getAuthenticateToken($token) ){ // Si el token es valido

        $dataUser = User::getDataByToken($token); //Se obtienen los datos del token

        return Offers::getOriginalQuery()
                      ->limit(3)
                      ->get();

      }

      return null;
    }

    public static function getListOffers($token){
      if( User::getAuthenticateToken($token) ){ // Si el token es valido

        $dataUser = User::getDataByToken($token); //Se obtienen los datos del token

        return Offers::getOriginalQuery()
                      ->get();

      }

      return null;
    }
}
