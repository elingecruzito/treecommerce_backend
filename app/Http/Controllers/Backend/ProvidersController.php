<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Providers;
use App\Models\Utils;

class ProvidersController extends Controller
{
    //
    public static function valorationByProduct(Request $request){
      if ( $request->validate([ 'token' => ['required'], 'id' => ['required'] ]) ){ // Si el valor token es requerido
        $data = Providers::getProviderByProduct($request['token'], $request['id']); // Se ejecuta la consulta
        if( $data != null ){ // Si se obtienen valores
          return Utils::success($data);
        }
      }
      //En caso de no optener valores
      return Utils::fail();
    }
}
