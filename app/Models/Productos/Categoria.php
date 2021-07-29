<?php

namespace App\Models\Productos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    
    public $timestamps = false;
    
    protected $table = "categoria";

    protected $fillable = [
        "categoria"
    ];

}
