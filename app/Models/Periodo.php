<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $table = 'periodo';
    protected $fillable = [
        'abertura',
        'fechamento',
        'semestre',
        'cadastrado_por'
    ];

    protected static function booted(){
        static::addGlobalScope('orderBySemestre', function ($query) {
            $query->orderBy('semestre', 'desc');
        });
    }

    public function usuario(){
        return $this->belongsTo(Usuario::class, 'cadastrado_por', 'login');
    }
}
