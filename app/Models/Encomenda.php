<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{
    use HasFactory;

    protected $fillable = ['estado', 'cliente_id', 'preco_total', 'notas', 'nif', 'tipo_pagamento', 'ref_pagamento', 'recibo_url'];

    public function clienteRef()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function tshirts()
    {
        return $this->hasMany(Tshirt::class);
    }
}
