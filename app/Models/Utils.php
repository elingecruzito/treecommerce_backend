<?php

namespace App\Models;

class Utils {

  CONST VALUE_DELETED = 1;
  CONST VALUE_ACTIVED = 0;

  public static function success($data){
    $quries = \DB::getQueryLog();
    return [ //Retorna los valores obtenidos
      'code' => Codes::CODE_OK,
      'message' => Codes::MESSAGE_OK,
      // 'length' => $data->count(),
      // 'query' => $quries[count($quries) - 1]['query'],
      'body' => $data
    ];
  }

  public static function successArray($data){
    return [ //Retorna los valores obtenidos
      'code' => Codes::CODE_OK,
      'message' => Codes::MESSAGE_OK,
      'length' => count($data),
      'body' => $data
    ];
  }

  public static function fail(){
    return [
        'code' => Codes::CODE_NOT_FOUND ,
        'message' => Codes::MESSAGE_NOT_FOUND,
    ];
  }

}
