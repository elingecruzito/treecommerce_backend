<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Providers extends Model
{
    use HasFactory;

    protected $table = 'providers';

    public $timestamps = true;

    protected $fillable = [
        'id', 'name', 'phone', 'address'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted'
    ];

    private static function getOriginalQuery(){
      return Providers::where('providers.deleted',Utils::VALUE_ACTIVED)
                        ->leftJoin('products', function ($join) {
                          $join->on('products.id_provider', '=', 'providers.id')
                          ->where('products.deleted', Utils::VALUE_ACTIVED);
                        })
                        ->leftJoin('valorations', function ($join) {
                          $join->on('valorations.id_product', '=', 'products.id')
                          ->where('products.deleted', Utils::VALUE_ACTIVED);
                        })
                        ->select(
                          'providers.id',
                          'providers.name',
                          'providers.phone',
                          'providers.address',
                        )
                        ->selectRaw('IF( AVG(tree_valorations.`starts`) is null, 0, AVG(tree_valorations.`starts`)) AS valoration')
                        ->orderByRaw('tree_providers.id DESC');
    }

    public static function getProviderByProduct($token, $id_product){

      if( User::getAuthenticateToken($token) ){ // Si el token es valido
        //Se optiene el ultimo producto visto
        return Providers::getOriginalQuery()
                        ->where('products.id', $id_product)
                        ->first();
      }

      return null;

    }
}
