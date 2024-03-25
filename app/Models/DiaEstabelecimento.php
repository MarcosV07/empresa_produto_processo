<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaEstabelecimento extends Model
{
    use HasFactory;

    protected $fillable = ["estabelecimento_id", "dia_id", "horario_inicio", "horario_fim"];
}
