<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pedidos;

class Cliente extends Model
{
    //
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'direccion',
        'estado'
    ];


    // Un cliente tiene MUCHOS pedidos
    public function pedidos()
    {
        return $this->hasMany(Pedidos::class);
    }
}
