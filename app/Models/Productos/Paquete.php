<?php

namespace App\Models\Productos;

use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    public $timestamps = false;
    
    protected $table = "paquete";

    protected $fillable = [
        'nombre',
        'imgNombreVirtual',
        'imgNombreFisico',
        'precio'
    ];    
}
