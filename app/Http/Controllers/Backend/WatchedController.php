<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Utils;

use App\Models\LastView;

class WatchedController extends Controller
{

  /*
    token => user identificador
  */
  public function completeList(Request $request){
    if ( $request->validate(['token' => ['required']]) ){ // Si el valor token es requerido]
      $data = LastView::completeList($request['token']); // Se ejecuta la consulta
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
  public function add(Request $request){
    if ( $request->validate(['token' => ['required'], 'id' => ['required']]) ){ // Si el valor token es requerido]
      $data = LastView::add($request['token'], $request['id']); // Se ejecuta la consulta
      if( $data != null ){ // Si se obtienen valores
        return Utils::success($data);
      }
    }
    //En caso de no optener valores
    return Utils::fail();
  }
}
