<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users_has_clientes extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'users_id',
        'clientes_id'
    ];
}
