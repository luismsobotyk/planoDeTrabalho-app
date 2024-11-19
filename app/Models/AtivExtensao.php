<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtivExtensao extends Model
{
    protected $table = 'ativ_extensao';
    protected $fillable = [
        'descricao',
        'carga_horaria',
        'plano_id'
    ];
}
