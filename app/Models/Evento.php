<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos';

    protected $fillable = [
        'name',
        'description',
        'efecto',
        'tipo',
    ];

    /**
     * Hacer cast automática de created_at a instancia de Carbon.
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];
}
