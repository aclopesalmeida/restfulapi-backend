<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{

    protected $fillable = ['nome'];
    
    public function classificacoes()
    {
        return $this->hasMany(Classificacao::class, 'aluno_id');
    }

    public function disciplinas()
    {
        return $this->belongsToMany(Disciplina::class);
    }
    
}
