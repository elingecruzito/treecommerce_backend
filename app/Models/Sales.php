<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'sales';

    public $timestamps = true;

    protected $fillable = [
        'id', 'id_user', 'id_status', 'id_direction','id_product', 'count', 'cost', 'total'. 'created_at'
    ];

    protected $hidden = [
        'updated_at',
        'deleted'
    ];

    private static function getOriginalQuery(){
      return Sales::where('sales.deleted', Utils::VALUE_ACTIVED)
      ->join('products', function ($join) {
        $join->on('products.id', '=', 'sales.id_product');
      })
      ->join('providers', function ($join) {
        $join->on('providers.id', '=', 'products.id_provider');
      })
      ->join('directions', function ($join) {
        $join->on('directions.id', '=', 'sales.id_direction');
      })
      ->join('estados', function ($join) {
        $join->on('estados.id', '=', 'directions.state');
      })
      ->join('municipios', function ($join) {
        $join->on('municipios.id', '=', 'directions.country');
      })
      ->join('status', function ($join) {
        $join->on('status.id', '=', 'sales.id_status');
      })
      ->select(
        'sales.id',
      	'sales.id_user',
        'status.status',
        'sales.id_status',
        'sales.id_product',
        'products.name',
        'sales.count',
        'sales.cost',
        'sales.total',
        'products.description',
      	'directions.address',
        'directions.cp',
        'directions.phone',
        'directions.person',
        'estados.estado',
        'municipios.municipio',
      	'sales.total',
      	'sales.created_at'
      )
      ->orderByRaw('tree_sales.created_at DESC');;
    }

    /*
      {
        'id' => int,
        'id_user' => int,
        'id_status' => int,
        'id_direction' => int,
        'total' => int,
        'created_at' => Date
      }
    */
    public static function add($token, $direction, $product, $count){
      if( User::getAuthenticateToken($token) ){ // Si el token es valido

        $dataUser = User::getDataByToken($token); //Se obtienen los datos del token
        $productModel = Products::where('id', $product)->first();

        //Se optiene el ultimo producto visto
        $model =  Sales::create([
          'id_user' => $dataUser->id,
          'id_status' => 1,
          'id_direction' => $direction,
          'total' => ($productModel->price * $count ),
          'deleted' => 0
        ]);

        return Sales::getOriginalQuery()
              ->where('sales.id', $model->id)
              ->first();
      }

      return null;
    }

    public static function list($token){
      if( User::getAuthenticateToken($token) ){ // Si el token es valido
        $dataUser = User::getDataByToken($token); //Se obtienen los datos del token
        //Se optiene el ultimo producto visto
        return Sales::getOriginalQuery()
              ->where('sales.id_user', $dataUser->id)
              ->get();
      }

      return null;
    }
}
