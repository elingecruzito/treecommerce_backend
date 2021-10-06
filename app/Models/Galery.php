<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    use HasFactory;

    protected $table = 'galery';

    protected $hidden = [
        'id_product',
        'created_at',
        'updated_at',
        'deleted'
    ];

    public static function getGalery($id_product){
      return Galery::where(['id_product' => $id_product, 'deleted' => Utils::VALUE_ACTIVED])->get();
    }
}
