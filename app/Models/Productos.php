<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'descripcion',
        'referencia',
        'stock',
        'tipo_productos_id',
        'clientes_id'
    ];
}
