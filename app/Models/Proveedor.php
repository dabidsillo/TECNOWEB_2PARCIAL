<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proveedor extends Model
{
    use HasFactory;
    protected $table = 'proveedores';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'nit',
        'empresa'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id');
    }
}
