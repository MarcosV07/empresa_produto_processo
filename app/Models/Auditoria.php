<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    use HasFactory;

    protected $fillable = ["tela_id", "usuario_id", "dados", "url", "dispositivo"];

    public function tela() {
        return $this->belongsTo(\App\Models\Tela::class);
    }

    public function usuario() {
        return $this->belongsTo(\App\Models\Usuario::class);
    }
}