<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tela extends Model
{
    use HasFactory;

    protected $fillable = ["nome", "rota", "menu", "icone", "modulo_id", "ordem", "auditoria"];

    public function modulo() {
        return $this->belongsTo(Modulo::class, "modulo_id", "id");
    }
}
