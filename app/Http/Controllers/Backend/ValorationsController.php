<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Utils;
use App\Models\Valorations;

class ValorationsController extends Controller
{
    /*
      token => user identificador
      id => product identificador
    */
    public static function previewall(Request $request){
        if ( $request->validate([ 'token' => ['required'], 'id' => ['required'] ]) ){ // Si el valor token es requerido
        $data = Valorations::getPreviewAll($request['token'], $request['id']); // Se ejecuta la consulta
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
    public static function previewpositives(Request $request){
        if ( $request->validate([ 'token' => ['required'], 'id' => ['required'] ]) ){ // Si el valor token es requerido
        $data = Valorations::getPreviewPositives($request['token'], $request['id']); // Se ejecuta la consulta
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
    public static function previewnegatives(Request $request){
        if ( $request->validate([ 'token' => ['required'], 'id' => ['required'] ]) ){ // Si el valor token es requerido
        $data = Valorations::getPreviewNegatives($request['token'], $request['id']); // Se ejecuta la consulta
        if( $data != null ){ // Si se obtienen valores
          return Utils::success($data);
        }
      }
      //En caso de no optener valores
      return Utils::fail();
    }
}
