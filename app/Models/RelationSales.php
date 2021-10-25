<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationSales extends Model
{
    use HasFactory;

    protected $table = 'relation_sales';

    public $timestamps = false;

    protected $fillable = [
        'id_sale', 'id_product', 'count', 'cost'
    ];


    public static function add($token, $product, $count, $sale){
      if( User::getAuthenticateToken($token) ){ // Si el token es valido

        $dataUser = User::getDataByToken($token); //Se obtienen los datos del token
        $productModel = Products::where('id', $product)->first();

        //Se optiene el ultimo producto visto
        return RelationSales::create([
          'id_sale' => $sale,
          'id_product' => $product,
          'count' => $count,
          'cost' => $productModel->price,
          'deleted' => 0
        ]);
      }

      return null;
    }
}
