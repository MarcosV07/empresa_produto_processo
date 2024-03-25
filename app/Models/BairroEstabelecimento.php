<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BairroEstabelecimento extends Model
{
    use HasFactory;

    protected $fillable = ["estabelecimento_id", "bairro_id", "valor_entrega", "distancia", "ativo"];
}
