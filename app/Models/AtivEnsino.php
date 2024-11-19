<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtivEnsino extends Model
{
    protected $table = 'ativ_ensino';
    protected $fillable = [
        'descricao',
        'carga_horaria',
        'plano_id'
    ];
}
