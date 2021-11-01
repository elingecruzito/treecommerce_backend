<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Utils;
use App\Models\LastView;
use App\Models\Offers;
use App\Models\Products;
use App\Models\Galery;

class HomeController extends Controller
{

    public function launcher(Request $request){
      if ( $request->validate(['token' => ['required']]) ){ // Si el valor token es requerido
        if($request['token'] == 'MqmaWWM7XxMdsd8V2y9srAu2gwbEyW5SrJz4PKqX2hWbvBDPMJqGg'){
          $data = [
            'token' => 'MqmaWWM7XxMdsd8V2y9srAu2gwbEyW5SrJz4PKqX2hWbvBDPMJqGg'
          ];
          return Utils::success($data);
        }
      }
      //En caso de no optener valores
      return Utils::fail();
    }

    public function carrucel(){

      $items = [
        "https://images.unsplash.com/photo-1520342868574-5fa3804e551c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=6ff92caffcdd63681a35134a6770ed3b&auto=format&fit=crop&w=1951&q=80",
        "https://images.unsplash.com/photo-1522205408450-add114ad53fe?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=368f45b0888aeb0b7b08e3a1084d3ede&auto=format&fit=crop&w=1950&q=80",
        "https://images.unsplash.com/photo-1519125323398-675f0ddb6308?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=94a1e718d89ca60a6337a6008341ca50&auto=format&fit=crop&w=1950&q=80",
        "https://images.unsplash.com/photo-1523205771623-e0faa4d2813d?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=89719a0d55dd05e2deae4120227e6efc&auto=format&fit=crop&w=1953&q=80",
        "https://images.unsplash.com/photo-1508704019882-f9cf40e475b4?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=8c6e5e3aba713b17aa1fe71ab4f0ae5b&auto=format&fit=crop&w=1352&q=80",
        "https://images.unsplash.com/photo-1519985176271-adb1088fa94c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=a0c8d632e977f94e5d312d9893258f59&auto=format&fit=crop&w=1355&q=80"
      ];

      return Utils::successArray($items);

    }

    /*
      token => user identificador
    */
    public function lastView(Request $request){

      if ( $request->validate(['token' => ['required']]) ){ // Si el valor token es requerido
        $data = LastView::getLast($request['token']); // Se ejecuta la consulta
        if( $data != null ){ // Si se obtienen valores
          return Utils::success($data);
        }
      }
      //En caso de no optener valores
      return Utils::fail();
    }

    /*
      token => user identificador
    */
    public function offers(Request $request){
      if ( $request->validate(['token' => ['required']]) ){ // Si el valor token es requerido
        $data = Offers::getLastOffers($request['token']); // Se ejecuta la consulta
        if( $data != null ){ // Si se obtienen valores
          return Utils::success($data);
        }
      }
      //En caso de no optener valores
      return Utils::fail();
    }

    /*
      token => user identificador
    */
    public function inspirated(Request $request){
      if ( $request->validate(['token' => ['required']]) ){ // Si el valor token es requerido
        $data = Products::inspirated($request['token']); // Se ejecuta la consulta
        if( $data != null ){ // Si se obtienen valores
          return Utils::success($data);
        }
      }
      //En caso de no optener valores
      return Utils::fail();
    }

    /*
      token => user identificador
    */
    public function history(Request $request){
      if ( $request->validate(['token' => ['required']]) ){ // Si el valor token es requerido
        $data = LastView::shortHistory($request['token']); // Se ejecuta la consulta
        if( $data != null ){ // Si se obtienen valores
          return Utils::success($data);
        }
      }
      //En caso de no optener valores
      return Utils::fail();
    }
}
