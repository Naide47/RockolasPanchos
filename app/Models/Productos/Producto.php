<?php

namespace App\Models\Productos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public $timestamps = false;
    // protected $primaryKey = "idProducto";
    
    protected $table = "producto";

    protected $fillable = [
        "idCategoria",
        "nombre",
        "existencias",
        "disponibles",
        "precioCompra",
        "precioUnitario"
    ];

}
