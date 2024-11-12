<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    protected $table = 'plano';
    protected $fillable = [
        'situacao',
        'periodo_id',
        'docente_id',
        'revisado_por'
    ];
}
