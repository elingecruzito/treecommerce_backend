<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipios extends Model
{
    use HasFactory;

    protected $table = 'municipios';

    public $timestamps = true;

    protected $fillable = [
        'id', 'municipio'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted'
    ];

}
