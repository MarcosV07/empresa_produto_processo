<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estabelecimento extends Model
{
    use HasFactory;

    protected $fillable = [
        "nome",
        "tipo_pessoa_id",
        "numero_documento",
        "razao_social",
        "nome_fantasia",
        "categoria_id",
        "email",
        "telefone",
        "whatsapp",
        "nome_contato",
        "cep",
        "logradouro",
        "bairro",
        "estado",
        "cidade",
        "numero",
        "complemento",
        "referencia",
        "descricao",
        "situacao_estabelecimento_id",
        "logotipo",
        "fundo_cabecalho",
        "valor_minimo_pedido",
        "permite_retirada",
        "latitude",
        "longitude",
        "user_id"
    ];

    public function tipoPessoa() {
        return $this->belongsTo(TipoPessoa::class);
    }

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    public function situacaoEstabelecimento() {
        return $this->belongsTo(SituacaoEstabelecimento::class);
    }
}
