<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nif', 'endereco', 'tipo_pagamento', 'ref_pagamento'];

    public function encomendas()
    {
        return $this->hasMany(Encomenda::class);
    }

    public function estampas()
    {
        return $this->hasMany(Estampa::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
}
