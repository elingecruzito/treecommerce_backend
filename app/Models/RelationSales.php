<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationSales extends Model
{
    use HasFactory;
    
    protected $table = 'relation_sales';
    public $timestamps = false;
}
