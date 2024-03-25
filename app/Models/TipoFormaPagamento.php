<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoFormaPagamento extends Model
{
    use HasFactory;

    protected $fillable = ["nome"];

    public function formasPagamento() {
        return $this->hasMany(FormaPagamento::class);
    }
}
