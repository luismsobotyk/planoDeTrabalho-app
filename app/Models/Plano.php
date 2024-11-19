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

    public function periodo(){
        return $this->belongsTo(Periodo::class);
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
}
