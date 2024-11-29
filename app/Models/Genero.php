<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Genero extends Model
{
    use HasFactory;
    protected $table = 'categoria';

    protected $fillable = [
        'nombre'
    ];
    public $timestamps = false;
    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_categoria');
    }
}
