<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    use HasFactory;

    protected $table = 'estados';

    public $timestamps = true;

    protected $fillable = [
        'id', 'estado'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted'
    ];
}
