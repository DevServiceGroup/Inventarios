<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_movimientos extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'movimiento_id',
        'productos_id',
        'cantidad'
    ];
}
