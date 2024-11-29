<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pago extends Model
{
    use HasFactory;
    protected $table = 'pagos';
    public $timestamps = false;
    protected $fillable = [
        'detalle',
        'tipo',
        'id_venta',
    ];
}
