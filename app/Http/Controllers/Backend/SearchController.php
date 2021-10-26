<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Products;
use App\Models\Utils;

class SearchController extends Controller
{

    /*
      token => user identificador
      searching => String for search product
    */
    public function search(Request $request){
      if ( $request->validate([ 'token' => ['required'], 'searching' => ['required'] ]) ){ // Si el valor token es requerido
        $data = Products::searching($request['token'], $request['searching']); // Se ejecuta la consulta
        if( $data != null ){ // Si se obtienen valores
          return Utils::success($data);
        }
      }
      //En caso de no optener valores
      return Utils::fail();
    }
}
