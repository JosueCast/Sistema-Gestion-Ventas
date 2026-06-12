<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'categoria_id',
        'estado',
    ];


    //que es booted?
    //es un metodo que se ejecuta cuando se crea o actualiza un producto, en este caso se 
    //utiliza para actualizar el estado del producto dependiendo del stock, 
    //si el stock es mayor a 0 el estado sera disponible, si el stock es igual a 0 el estado sera no disponible
    protected static function booted()
    {
        static::saving(function ($producto) {
            $producto->estado = $producto->stock > 0 ? 'Disponibles' : 'No Disponibles';
        });
    }

    public function pedidos()
    {
        return $this->belongsToMany(Pedidos::class)
            ->withPivot('cantidad', 'precio_unitario');
    }

    //¡¡Un producto pertenece a una categoría!!
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
