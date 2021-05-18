<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cor extends Model
{
    use HasFactory;

    protected $primaryKey = 'codigo';
    protected $keyType = 'string';

    protected $fillable = ['codigo', 'nome'];

    public function tshirts()
    {
        return $this->hasMany(Tshirt::class, 'cor_codigo', 'codigo');
    }
}
