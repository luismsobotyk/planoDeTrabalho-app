<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $table = 'aula';
    protected $fillable = [
        'disciplina',
        'curso',
        'carga_horaria',
        'plano_id'
    ];
}
