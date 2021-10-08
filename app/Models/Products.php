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

    public static function inspirated($token){

      if( User::getAuthenticateToken($token) ){ // Si el token es valido

        // Se optiene los 3 productos con las mejores calificaciones respecto a la categoria
        return Products::where([
                          'id_category' => LastView::getLast($token)->id_category,
                          'products.deleted' => Utils::VALUE_ACTIVED,
                          ['unity', '>', 0],
                        ])
                        ->join('valorations', function ($join) {
                          $join->on('products.id', '=', 'valorations.id_product')
                          ->where('valorations.deleted', Utils::VALUE_ACTIVED);
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
                        ->groupBy('valorations.id_product')
                        ->orderByRaw('AVG(tree_valorations.`starts`) DESC')
                        ->limit(3)
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

    public static function inspiratedList($token){

      if( User::getAuthenticateToken($token) ){ // Si el token es valido

        // Se optiene los productos con las mejores calificaciones respecto a la categoria
        return Products::where([
                          'id_category' => LastView::getLast($token)->id_category,
                          'products.deleted' => Utils::VALUE_ACTIVED,
                          ['unity', '>', 0],
                        ])
                        ->join('valorations', function ($join) {
                          $join->on('products.id', '=', 'valorations.id_product')
                          ->where('valorations.deleted', Utils::VALUE_ACTIVED);
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
                        ->groupBy('valorations.id_product')
                        ->orderByRaw('AVG(tree_valorations.`starts`) DESC')
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

    public static function searching($token, $product){
      if( User::getAuthenticateToken($token) ){ // Si el token es valido
        // Se obtienen los productos que contengan el texto
        return Products::where([
                          'products.deleted' => Utils::VALUE_ACTIVED,
                          ['unity', '>', 0],
                          ['name', 'like', '%'.$product.'%' ],
                        ])
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
                          'galery.path',
                          // 'offers.percentage'
                        )
                        ->groupBy('products.id')
                        ->selectRaw('IF( tree_offers.percentage is null, 0, tree_offers.percentage) AS percentage')
                        ->get();

      }
      return null;
    }

    public static function product($token, $id){
      if( User::getAuthenticateToken($token) ){ // Si el token es valido
        // Se obtienen los productos que contengan el texto
        return Products::where([
                          'products.deleted' => Utils::VALUE_ACTIVED,
                          'products.id' => $id
                        ])
                        ->join('categories', function ($join) {
                          $join->on('categories.id', '=', 'products.id_category');
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
                        )
                        ->groupBy('products.id')
                        ->selectRaw('IF( tree_offers.percentage is null, 0, tree_offers.percentage) AS percentage')
                        ->first();

      }
      return null;
    }
}
