<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Products;
use App\Models\Utils;

class InspiratedController extends Controller
{
  /*
    token => user identificador
  */
  public function list(Request $request){
    if ( $request->validate(['token' => ['required']]) ){ // Si el valor token es requerido
      $data = Products::inspiratedList($request['token']); // Se ejecuta la consulta
      if( $data != null ){ // Si se obtienen valores
        return Utils::success($data);
      }
    }
    //En caso de no optener valores
    return Utils::fail();
  }
}
