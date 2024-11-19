<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoPessoais extends Model
{
    protected $table = 'info_pessoais';
    protected $fillable = [
        'categoria',
        'regime',
        'plano_id'
    ];
}
