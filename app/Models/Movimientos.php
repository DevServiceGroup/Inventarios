<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimientos extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'fecha',
        'cantidad',
        'estados_id',
        'tipo',
        'clientes_id'
    ];
}
