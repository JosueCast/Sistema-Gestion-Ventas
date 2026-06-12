<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //
    protected $fillable = [
        'nombre',
        'estado'
    ];

    //¡¡Una categoría tiene MUCHOS productos!!
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }   
}
