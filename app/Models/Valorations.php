<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valorations extends Model
{
    use HasFactory;

    protected $table = 'valorations';

    public $timestamps = true;

    protected $fillable = [
        'id', 'starts', 'comment', 'id_user', 'id_product'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted'
    ];

    private static function getOriginalQuery(){
      return Valorations::where('valorations.deleted', Utils::VALUE_ACTIVED)
                        ->leftJoin('products', function ($join) {
                          $join->on('products.id', '=', 'valorations.id_product');
                        })
                        ->select(
                          'valorations.id',
                          'valorations.starts',
                          'valorations.comment',
                          'products.name as product'
                        )
                        ->orderByRaw('tree_valorations.created_at DESC');
    }

    public static function getPreviewAll($token, $id_product){

      if( User::getAuthenticateToken($token) ){ // Si el token es valido
        //Se optiene el ultimo producto visto
        return Valorations::getOriginalQuery()
                        ->where('valorations.id_product', $id_product)
                        ->limit(3)
                        ->get();
      }

      return null;
    }

    public static function getPreviewPositives($token, $id_product){

      if( User::getAuthenticateToken($token) ){ // Si el token es valido
        //Se optiene el ultimo producto visto
        return Valorations::getOriginalQuery()
                        ->where([
                          ['valorations.id_product','=', $id_product],
                          ['valorations.starts','>', 3],
                        ])
                        ->limit(3)
                        ->get();
      }

      return null;
    }

    public static function getPreviewNegatives($token, $id_product){

      if( User::getAuthenticateToken($token) ){ // Si el token es valido
        //Se optiene el ultimo producto visto
        return Valorations::getOriginalQuery()
                        ->where([
                          ['valorations.id_product','=', $id_product],
                          ['valorations.starts','<=', 3],
                        ])
                        ->limit(3)
                        ->get();
      }

      return null;
    }
}
