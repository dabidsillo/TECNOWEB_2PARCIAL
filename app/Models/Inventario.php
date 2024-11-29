<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventario extends Model
{
    use HasFactory;
    protected $table = 'inventarios';

    protected $fillable = [
        'nombre',
        'cantidad_disponible',
        'id_producto'
    ];
    public $timestamps = false;
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
