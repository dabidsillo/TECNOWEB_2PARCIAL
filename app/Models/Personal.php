<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Personal extends Model
{
    use HasFactory;
    protected $table = 'personales';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'profesion'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id');
    }
}
