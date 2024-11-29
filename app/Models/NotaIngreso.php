<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotaIngreso extends Model
{
    use HasFactory;
    protected $table = 'nota_ingresos';

    protected $fillable = [
        'cantidad',
        'costo',
        'total',
        'id_inventario',
        'id_proveedor',
        'id_personal',
    ];
    public $timestamps = false;
    public function inventario()
    {
        return $this->belongsTo(Inventario::class, 'id_inventario');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }
}
