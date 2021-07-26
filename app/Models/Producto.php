<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public $timestamps = false;
    protected $primaryKey = "idProducto";
    
    protected $table = "productos";

    protected $fillable = [
        "idCategoria",
        "nombre",
        "existencias",
        "disponibles",
        "precioCompra",
        "precioUnitario"
    ];

}
