<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagen',
        'stock',
        'id_categoria',
        'id_promocion'
    ];
    public $timestamps = false;
    public function promocion()
    {
        return $this->belongsTo(Promocion::class, 'id_promocion');
    }
}
