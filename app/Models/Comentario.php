<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'comentario';
    protected $fillable = [
        'texto',
        'resolvido',
        'cadastrado_por',
        'plano_id'
    ];

    public function usuario(){
        return $this->belongsTo(Usuario::class, 'cadastrado_por', 'login');
    }
}
