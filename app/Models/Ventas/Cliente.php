<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuarios\Persona;
use App\Models\Ventas\Venta;

class Cliente extends Model
{
    // use HasFactory;
    public $timestamps = false;
    
    protected $table = "cliente";

    public function personas()
    {
        return $this->belongsTo('Persona', 'persona_id');
    }

    public function ventas()
    {
        return $this->hasMany('Venta', 'cliente_id');
    }

}
