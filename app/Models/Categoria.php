<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    
    public $timestamps = false;
    protected $primaryKey = "idCategoria";
    
    protected $table = "categoria";

    protected $fillable = [
        "categoria"
    ];

}
