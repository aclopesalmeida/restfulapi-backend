<?php

namespace App\Repositorios;

use Illuminate\Database\Eloquent\Model;
use App\Interfaces\IUtilizadorRepositorio;
use App\Models\Utilizador;

class UtilizadorRepositorio extends GenericoRepositorio implements IUtilizadorRepositorio
{

    public function __construct(Utilizador $modelo)
    {
        $this->modelo = $modelo;
    }

    public function verificar(string $email)
    {
        $utilizador = $this->modelo->where('email', $email)->first();
        return $utilizador;
    }
    
}