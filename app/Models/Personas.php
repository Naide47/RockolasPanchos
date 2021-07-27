<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    protected $table = 'persona';

    use HasFactory;

    protected $fillable = ["id", "nombre", "colonia", "calle", "codigoPostal", "telefono", "celular"];
}
