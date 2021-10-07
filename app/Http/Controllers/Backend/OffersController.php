<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Offers;
use App\Models\Utils;

class OffersController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      // $this->middleware('auth');
  }

  public function list(Request $request){
    if ( $request->validate(['token' => ['required']]) ){ // Si el valor token es requerido
      $data = Offers::getListOffers($request['token']); // Se ejecuta la consulta
      if( $data != null ){ // Si se obtienen valores
        return Utils::success($data);
      }
    }
    //En caso de no optener valores
    return Utils::fail();
  }
}
