<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipos';

    protected $fillable = [
        'usuario_id',
        'pokemon1_id', 'level1', 'hp1',
        'pokemon2_id', 'level2', 'hp2',
        'pokemon3_id', 'level3', 'hp3',
        'pokemon4_id', 'level4', 'hp4',
        'pokemon5_id', 'level5', 'hp5',
        'pokemon6_id', 'level6', 'hp6',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}