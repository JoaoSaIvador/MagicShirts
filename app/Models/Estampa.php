<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Preco;

class Estampa extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['cliente_id', 'categoria_id', 'nome', 'descricao', 'imagem_url', 'informacao_extra'];

    public function tshirts()
    {
        return $this->hasMany(Tshirt::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class)->withTrashed();
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class)->withTrashed();
    }

    public function getImagemFullUrl()
    {
        if (is_null($this['cliente_id'])) {
            return asset('storage/estampas/'. $this['imagem_url']);
        }
        else
        {
            return route('Stamp.image', ['estampa' => $this]);
        }
    }

    public function getPreco()
    {
        $precos = Preco::first();

        if(is_null($this->cliente_id)) {
            return $precos->preco_un_catalogo;
        } else {
            return $precos->preco_un_proprio;
        }
    }
}
