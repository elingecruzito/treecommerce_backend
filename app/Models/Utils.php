<?php

namespace App\Models;

class Utils {

  CONST VALUE_DELETED = 1;
  CONST VALUE_ACTIVED = 0;

  public static function success($data){
    return [ //Retorna los valores obtenidos
      'code' => Codes::CODE_OK,
      'message' => Codes::MESSAGE_OK,
      'length' => $data->count(),
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
