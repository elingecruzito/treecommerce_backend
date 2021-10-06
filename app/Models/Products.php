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
                        ->groupBy('valorations.id_product')
                        ->orderByRaw('AVG(tree_valorations.`starts`) DESC')
                        ->limit(3)
                        ->select(
                          'products.id',
                          'products.name',
                          'products.price',
                          'products.description',
                          'products.unity',
                          'categories.category'
                        )
                        ->get();

      }

      return null;

    }
}
