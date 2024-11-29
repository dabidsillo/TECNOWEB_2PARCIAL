<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Venta extends Model
{
    use HasFactory;
    protected $table = 'ventas';
    public $timestamps = false;
    protected $fillable = [
        'total',
        'id_cliente',
        'id_servicio'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function pago()
    {
        return $this->hasOne(Pago::class, 'id_venta');
    }

    public function detalleVenta()
    {
        return $this->hasMany(DetalleVenta::class, 'id_venta');
    }
}
