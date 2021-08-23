<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    public $timestamps = false;

    protected $table = "cliente";

    protected $fillable = ["persona_id"];
}