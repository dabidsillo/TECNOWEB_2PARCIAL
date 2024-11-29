<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Formula extends Model
{
    use HasFactory;
    protected $table = 'formula';
    public $timestamps = false;

    protected $fillable = ['nombre', 'descripcion'];
}
