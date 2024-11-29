<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rol extends Model
{
    use HasFactory;
    protected $table = 'roles';
    public $timestamps = false;
    protected $fillable  = [ 
        'nombre', 
    ];


    public function usuario()
    {
        return $this->hasMany(Usuario::class, 'id_rol');
    }
}
