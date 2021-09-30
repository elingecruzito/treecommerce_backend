<?php

namespace App\Models;

class Codes{

    const CODE_OK = 200; //La solicitud ha tenido éxito
    const CODE_CREATED = 201; //La solicitud ha tenido éxito y se ha creado un nuevo recurso como resultado de ello
    const CODE_BAD_REQUEST = 400; // No pudo interpretar la solicitud dada una sintaxis inválida
    const CODE_NOT_FOUND = 404; // El servidor no pudo encontrar el contenido solicitado
    const CODE_INTERNAL_SERVER_ERROR = 500; //El servidor ha encontrado una situación que no sabe cómo manejarla

//----------------------------------------------------------------------------------------------------------------------------------

  const MESSAGE_OK = "La solicitud ha tenido éxito.";
  const MESSAGE_CREATED = "La solicitud ha tenido éxito y se ha creado un nuevo registro";
  const MESSAGE_BAD_REQUEST = "No pudo interpretar la solicitud dada una sintaxis inválida";
  const MESSAGE_NOT_FOUND = "El servidor no pudo encontrar el contenido solicitado";
  const MESSAGE_INTERNAL_SERVER_ERROR = "El servidor ha encontrado una situación que no sabe cómo manejarla";

}
