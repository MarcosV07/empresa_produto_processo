<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPagamento extends Model
{
    use HasFactory;

    protected $fillable = ["nome", "tipo_forma_pagamento_id", "foto"];

    public function tipoFormaPagamento() {
        return $this->belongsTo(TipoFormaPagamento::class);
    }
}
