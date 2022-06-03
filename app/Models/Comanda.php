<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comanda extends Model
{
    use HasFactory;

    public function producto()
    {
        return $this->belongsToMany(Producto::class, 'comandas_productos', 'comanda_id', 'producto_id');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'users_comandas', 'comanda_id', 'user_id');
    }
}
