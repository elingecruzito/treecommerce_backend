<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted'
    ];

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
                      ->selectRaw('IF( tree_offers.percentage is null, 0, tree_offers.percentage) AS percentage');
    }

    public static function inspirated($token){

      if( User::getAuthenticateToken($token) ){ // Si el token es valido

        // Se optiene los 3 productos con las mejores calificaciones respecto a la categoria
        return Products::getOriginalQuery()
                    ->where([
                      'id_category' => LastView::getLast($token)->id_category,
                      ['unity', '>', 0],
                    ])
                    ->groupBy('products.id')
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
                          ->groupBy('valorations.id_product')
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
}
