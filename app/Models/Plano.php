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

    protected static function booted(){
        static::addGlobalScope('orderByPeriodo', function ($query) {
            $query->orderBy('periodo_id', 'desc');
        });
    }

    public function periodo(){
        return $this->belongsTo(Periodo::class);
    }

    public function usuario(){
        return $this->belongsTo(Usuario::class, 'docente_id', 'login');
    }

    public function revisado_por(){
        return $this->belongsTo(Usuario::class, 'revisado_por', 'login');
    }

    public function informacoesPessoais(){
        return $this->hasOne(InfoPessoais::class, 'plano_id');
    }
    public function aulas(){
        return $this->hasMany(Aula::class, 'plano_id');
    }
    public function atividadesAdministrativas(){
        return $this->hasMany(AtivAdministrativa::class, 'plano_id');
    }
    public function atividadesExtensao(){
        return $this->hasMany(AtivExtensao::class, 'plano_id');
    }
    public function atividadesEnsino(){
        return $this->hasMany(AtivEnsino::class, 'plano_id');
    }
    public function atividadesPesquisa(){
        return $this->hasMany(AtivPesquisa::class, 'plano_id');
    }
    public function comentarios(){
        return $this->hasMany(Comentario::class, 'plano_id');
    }
    public function comentario(){
        return $this->hasOne(Comentario::class, 'plano_id')->where('resolvido', false)->latest();
    }
}
