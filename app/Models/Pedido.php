<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $fillable = ["status_pedido_id", "estabelecimento_id", "produto_id", "cliente_id", "valor_pedido", "created_at"];    

    public function produto() {
        return $this->belongsTo(Produto::class);
    }

    public function estabelecimento() {
        return $this->belongsTo(Estabelecimento::class);
    }

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    public function statusPedido() {
        return $this->belongsTo(StatusPedido::class);
    }
}
