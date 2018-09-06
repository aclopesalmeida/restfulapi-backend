<?php

namespace App\Repositorios;

use Illuminate\Database\Eloquent\Model;
use App\Interfaces\IAlunoRepositorio;
use App\Models\Aluno;

class AlunoRepositorio extends GenericoRepositorio implements IAlunoRepositorio
{

    public function __construct(Aluno $modelo)
    {
        $this->modelo = $modelo;
    }
}