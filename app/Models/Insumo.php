<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Insumo extends Model
{
    use HasFactory;
    protected $table = 'insumos';
    public $timestamps = false;

    protected $fillable = ['nombre', 'cantidad', 'precio'];
}
