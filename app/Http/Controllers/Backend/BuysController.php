<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Sales;
use App\Models\RelationSales;
use App\Models\Utils;

class BuysController extends Controller
{
    //
    public function add(Request $request){
      if ( $request->validate([
        'token' => ['required'],
        'product' => ['required'],
        'count' => ['required'],
        'direction' => ['required'],
      ])){ // Si el valor token es requerido
        $sale = Sales::add($request['token'], $request['direction'], $request['product'], $request['count']); // Se ejecuta la consulta
        $relation = RelationSales::add($request['token'], $request['product'], $request['count'], $sale->id);
        if( $sale != null && $relation != null){ // Si se obtienen valores
          return Utils::success($sale);
        }
      }
      //En caso de no optener valores
      return Utils::fail();
    }

    public function list(Request $request){
      if ( $request->validate([ 'token' => ['required'] ])){ // Si el valor token es requerido
        $data = Sales::list($request['token']); // Se ejecuta la consulta
        if( $data != null){ // Si se obtienen valores
          return Utils::success($data);
        }
      }
      //En caso de no optener valores
      return Utils::fail();
    }
}
