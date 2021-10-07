<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    use HasFactory;

    protected $table = 'offers';

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted'
    ];

    public static function getLastOffers($token){
      if( User::getAuthenticateToken($token) ){ // Si el token es valido

        $dataUser = User::getDataByToken($token); //Se obtienen los datos del token

        return Offers::where('offers.deleted', Utils::VALUE_ACTIVED)
                      ->orderByRaw('tree_offers.created_at DESC')
                      ->join('products', function ($join) {
                        $join->on('products.id', '=', 'offers.id_product')
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
                      ->select(
                        'products.id',
                        'products.name',
                        'products.price',
                        'products.description',
                        'products.unity',
                        'categories.category',
                        'galery.path'
                      )
                      ->groupBy('offers.id_product')
                      ->limit(3)
                      ->get();

      }

      return null;
    }
}
