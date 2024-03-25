<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValorDistancia extends Model
{
    use HasFactory;

    protected $fillable = ["km_inicial", "km_final", "valor"];
}
