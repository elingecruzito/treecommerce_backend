<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    public $timestamps = true;

    protected $fillable = [
        'id', 'name', 'price', 'description', 'unity', 'id_provider', 'id_category'
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

      return Products::where([
                        'products.deleted' => Utils::VALUE_ACTIVED,
                        ['unity', '>', 0],
                      ])
                      ->join('categories', function ($join) {
                        $join->on('categories.id', '=', 'products.id_category');
                      })
                      ->join('providers', function ($join) {
                        $join->on('products.id_provider', '=', 'providers.id');
                      })
                      ->leftJoin('offers', function ($join) {
                        $join->on('offers.id_product', '=', 'products.id')
                        ->where('offers.deleted', Utils::VALUE_ACTIVED)
                        ->orderByRaw('offers.created_at DESC');
                      })
                      ->leftJoin('valorations', function ($join) {
                        $join->on('products.id', '=', 'valorations.id_product')
                        ->where('valorations.deleted', Utils::VALUE_ACTIVED);
                      })
                      ->leftJoin('favorites', function ($join) {
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
                      ->groupBy('products.id');
    }

    public static function inspirated($token){

      if( User::getAuthenticateToken($token) ){ // Si el token es valido

        // Se optiene los 3 productos con las mejores calificaciones respecto a la categoria
        return Products::getOriginalQuery()
                    ->where([
                      'id_category' => LastView::getLast($token)->id_category,
                      ['unity', '>', 0],
                    ])
                    ->orderByRaw('AVG(tree_valorations.`starts`) DESC')
                    ->limit(3)
                    ->get();
      }

      return null;

    }

    public static function inspiratedList($token){

      if( User::getAuthenticateToken($token) ){ // Si el token es valido

        // Se optiene los productos con las mejores calificaciones respecto a la categoria
        return Products::getOriginalQuery()
                          ->where([
                            'id_category' => LastView::getLast($token)->id_category,
                            ['unity', '>', 0],
                          ])
                          ->orderByRaw('AVG(tree_valorations.`starts`) DESC')
                          ->get();
      }

      return null;
    }

    public static function searching($token, $product){
      if( User::getAuthenticateToken($token) ){ // Si el token es valido
        // Se obtienen los productos que contengan el texto
        return Products::getOriginalQuery()
                        ->where([
                          ['unity', '>', 0],
                          ['products.name', 'like', '%'.$product.'%' ],
                        ])
                        ->get();
      }
      return null;
    }

    public static function productsByProvider($token, $id_product){
      if( User::getAuthenticateToken($token) ){ // Si el token es valido

        return Products::getOriginalQuery()
                        ->where('id_provider', Products::where('id', $id_product)->first()->id_provider)
                        ->orderByRaw('AVG(tree_valorations.`starts`) DESC')
                        ->limit(2)
                        ->get();
      }
      return null;
    }
}
