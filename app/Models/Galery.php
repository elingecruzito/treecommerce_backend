<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    use HasFactory;

    protected $table = 'galery';

    public $timestamps = true;

    protected $fillable = [
        'id', 'id_product', 'path'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted'
    ];

    /*
      {
        'id' => int,
        'id_product' => int,
        'path' => String,
      }
    */
    public static function getGalery($id_product){
      return Galery::where(['id_product' => $id_product, 'deleted' => Utils::VALUE_ACTIVED])->get();
    }

    /*
      {
        'id' => int,
        'id_product' => int,
        'path' => String,
      }
    */
    public static function getCover($id_product){
      return Galery::where(['id_product' => $id_product, 'deleted' => Utils::VALUE_ACTIVED])->first();
    }
}
