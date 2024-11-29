<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable 
{
    use HasFactory;
    use HasRoles;

    protected $table = 'usuarios';
    public $timestamps = false;
    protected $fillable = [
        'email',
        'password',
        'nombre',
        'telefono',
        'direccion'
    ];
}
