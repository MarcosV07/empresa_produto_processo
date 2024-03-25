<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = ["nome", "valor", "estabelecimento_id", "categoria_produto_id"];

    public function estabelecimento() {
        return $this->belongsTo(Estabelecimento::class);
    }

    public function categoriaProduto() {
        return $this->belongsTo(CategoriaProduto::class);
    }
}
