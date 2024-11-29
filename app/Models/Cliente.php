<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'clientes';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'ci'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id');
    }
}
