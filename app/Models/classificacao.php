<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classificacao extends Model
{
    public $table = 'classificacoes';
    protected $primaryKey = 'aluno_id';
    public $fillable = ['nota', 'disciplina_id', 'aluno_id'];


    //primary key: disciplina_id, aluno_id

    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'disciplina_id');
    }
}
