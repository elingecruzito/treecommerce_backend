<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Products;
use App\Models\Utils;

class ProductosController extends Controller
{
    /*
      token => user identificador
      id => product identificador
    */
    public function product(Request $request){
      if ( $request->validate([ 'token' => ['required'], 'id' => ['required'] ]) ){ // Si el valor token es requerido
        $data = Products::product($request['token'], $request['id']); // Se ejecuta la consulta
        if( $data != null ){ // Si se obtienen valores
          return Utils::success($data);
        }
      }
      //En caso de no optener valores
      return Utils::fail();
    }

    /*
      token => user identificador
      id => product identificador
    */
    public function productsByProvider(Request $request){
      if ( $request->validate([ 'token' => ['required'], 'id' => ['required'] ]) ){ // Si el valor token es requerido
        $data = Products::productsByProvider($request['token'], $request['id']); // Se ejecuta la consulta
        if( $data != null ){ // Si se obtienen valores
          return Utils::success($data);
        }
      }
      //En caso de no optener valores
      return Utils::fail();
    }

    public function favoritesListProducts(Request $request){
      if ( $request->validate([ 'token' => ['required'] ]) ){ // Si el valor token es requerido
        $data = Products::favoritesListProducts($request['token']); // Se ejecuta la consulta
        if( $data != null ){ // Si se obtienen valores
          return Utils::success($data);
        }
      }
      //En caso de no optener valores
      return Utils::fail();
    }
}
