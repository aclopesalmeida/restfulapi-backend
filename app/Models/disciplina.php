<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{

    public function alunos()
    {
        return $this->belongsToMany(Aluno::class);
    }
}
