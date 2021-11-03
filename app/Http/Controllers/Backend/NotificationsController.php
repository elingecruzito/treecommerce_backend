<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Notifications;
use App\Models\Utils;

class NotificationsController extends Controller
{
    //
    /*
      token => user identificador
    */
    public function list(Request $request){
      if ( $request->validate(['token' => ['required']]) ){ // Si el valor token es requerido
        $data = Notifications::listNotifications($request['token']); // Se ejecuta la consulta
        if( $data != null ){ // Si se obtienen valores
          return Utils::success($data);
        }
      }
      //En caso de no optener valores
      return Utils::fail();
    }
}
