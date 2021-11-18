<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Utils;

use App\Models\Directions;
use App\Models\RelacionEstadosMunicipios;
use App\Models\Estados;
use App\Models\Municipios;

class DirectionsController extends Controller
{
  /*
    token => user identificador
  */
  public function completeList(Request $request){
    if ( $request->validate(['token' => ['required']]) ){ // Si el valor token es requerido]
      $data = Directions::getListDirections($request['token']); // Se ejecuta la consulta
      if( $data != null ){ // Si se obtienen valores
        return Utils::success($data);
      }
    }
    //En caso de no optener valores
    return Utils::fail();
  }

  public function getStates(Request $request){
    if ( $request->validate(['token' => ['required']]) ){ // Si el valor token es requerido]
      $data = Estados::getStates($request['token']); // Se ejecuta la consulta
      if( $data != null ){ // Si se obtienen valores
        return Utils::success($data);
      }
    }
    //En caso de no optener valores
    return Utils::fail();
  }

  public function getCountry(Request $request){
    if ( $request->validate(['token' => ['required'], 'id_estado' => ['required']]) ){ // Si el valor token es requerido]
      $data = Municipios::getCountry($request['token'], $request['id_estado']); // Se ejecuta la consulta
      if( $data != null ){ // Si se obtienen valores
        return Utils::success($data);
      }
    }
    //En caso de no optener valores
    return Utils::fail();
  }

  public function add(Request $request){
    if( $request->validate([
        'token' => ['required'],
        'state' => ['required'],
        'country' => ['required'],
        'address' => ['required'],
        'cp' => ['required'],
        'phone' => ['required'],
        'person' => ['required'],
      ])){
        $data = Directions::add(
          $request['token'],
          $request['state'],
          $request['country'],
          $request['address'],
          $request['cp'],
          $request['phone'],
          $request['person']
        ); // Se ejecuta la consulta
        if( $data != null ){ // Si se obtienen valores
          return Utils::success($data);
        }
      }
      //En caso de no optener valores
      return Utils::fail();
  }
}
