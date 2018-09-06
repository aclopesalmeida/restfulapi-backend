<?php

namespace App\Repositorios;

use Illuminate\Database\Eloquent\Model;
use App\Interfaces\IDisciplinaRepositorio;
use App\Models\Disciplina;

class DisciplinaRepositorio extends GenericoRepositorio implements IDisciplinaRepositorio
{

    public function __construct(Disciplina $modelo)
    {
        $this->modelo = $modelo;
    }
}