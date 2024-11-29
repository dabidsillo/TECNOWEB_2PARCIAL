<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetalleVenta extends Model
{
    use HasFactory;
    protected $table = 'detalle_ventas';
    public $timestamps = false;
    protected $fillable = [
        'cantidad',
        'total',
        'id_venta',
        'id_producto'
    ];


    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
