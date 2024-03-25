<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tela;

class PerfilTela extends Model
{
    use HasFactory;

    protected $table = "perfis_telas";
    protected $fillable = ["perfil_id", "tela_id"];

    public function tela() {
        return $this->hasMany(Tela::class, "id", "tela_id");
    }
}
