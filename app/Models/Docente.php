<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $fillable = [
        "id", "nombres","apellidos","dni"
    ];

    protected $table = "docente";
}