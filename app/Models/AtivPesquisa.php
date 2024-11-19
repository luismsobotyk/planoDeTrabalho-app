<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtivPesquisa extends Model
{
    protected $table = 'ativ_pesquisa';
    protected $fillable = [
        'descricao',
        'carga_horaria',
        'plano_id'
    ];
}
