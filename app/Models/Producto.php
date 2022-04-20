<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public function comanda()
    {
        return $this->belongsToMany(Comanda::class, 'comandas_productos', 'producto_id', 'comanda_id');
    }
}
