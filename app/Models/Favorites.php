<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    use HasFactory;

    protected $table = 'favorites';

    public $timestamps = true;

    protected $fillable = [
        'id', 'id_user', 'id_product'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted'
    ];
}
