<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtivAdministrativa extends Model
{
    protected $table = 'ativ_administrativa';
    protected $fillable = [
        'descricao',
        'portaria',
        'carga_horaria',
        'plano_id'
    ];
}
