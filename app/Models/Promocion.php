<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promocion extends Model
{
    use HasFactory;
    protected $table = 'promociones';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'descuento',
    ];
}
