<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tshirt extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['estampa_id', 'cor_codigo', 'tamanho', 'quantidade', 'preco_un'];

    public function encomendaRef()
    {
        return $this->belongsTo(Encomenda::class);
    }

    public function estampaRef()
    {
        return $this->belongsTo(Estampa::class);
    }

    public function corRef()
    {
        return $this->belongsTo(Cor::class, 'cor_codigo', 'codigo')->withTrashed();
    }
}
