<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPagamentoEstabelecimento extends Model
{
    use HasFactory;

    protected $fillable = ["estabelecimento_id", "forma_pagamento_id"];
}
