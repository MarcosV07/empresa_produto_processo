<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = "users";
    
    protected $fillable = ["name", "email", "password", "perfil_id", "ativo", "estabelecimento_id", "cliente_id"];

    public function perfil() {
        return $this->belongsTo(\App\Models\Perfil::class, "perfil_id", "id");
    }

    public function cliente() {
        return $this->belongsTo(\App\Models\Cliente::class, "cliente_id", "id");
    }
}
