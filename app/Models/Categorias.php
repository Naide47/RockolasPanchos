<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $table = 'categoria';

    use HasFactory;

    protected $fillable = ["categoria"];
}