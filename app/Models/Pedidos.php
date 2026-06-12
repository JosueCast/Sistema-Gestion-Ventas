<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;

class Pedidos extends Model
{
    protected $fillable = ['cliente_id', 'total', 'estado', 'notas'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function productos()
    {
        return $this->belongsToMany(
            Producto::class,
            'pedidos_producto',   // nombre exacto de la tabla pivot
            'pedido_id',         // FK hacia pedidos
            'producto_id'        // FK hacia productos
        )
            ->withPivot('cantidad', 'precio_unitario')
            ->withTimestamps();
    }
}
