<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Utils;
use App\Models\Galery;

class GaleryController extends Controller
{

    /*
      product => id product
    */
    public function galery(Request $request){
      if ( $request->validate(['product' => ['required']]) ){ // Si el valor token es requerido
        $data = Galery::getGalery($request['product']); // Se ejecuta la consulta
        if( $data != null ){ // Si se obtienen valores
            return Utils::success($data);
        }
      }
      //En caso de no optener valores
      return Utils::fail();
    }

    /*
      product => id product
    */
    public function cover(Request $request){
      if ( $request->validate(['product' => ['required']]) ){ // Si el valor token es requerido
        $data = Galery::getCover($request['product']); // Se ejecuta la consulta
        if( $data != null ){ // Si se obtienen valores
            return Utils::success($data);
        }
      }
      //En caso de no optener valores
      return Utils::fail();
    }
}
