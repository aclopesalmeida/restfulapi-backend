<?php

namespace App\Repositorios;

use App\Interfaces\IClassificacaoRepositorio;
use App\Models\Classificacao;


class ClassificacaoRepositorio extends GenericoRepositorio implements IClassificacaoRepositorio
{
    public function __construct(Classificacao $modelo)
    {
        $this->modelo = $modelo;
    }

    public function getComposite(int $aluno_id, int $disciplina_id, array $relacoes = null)
    {
        $query = $this->modelo->where('disciplina_id', $disciplina_id)->where('aluno_id', $aluno_id);
        if(is_null($relacoes)) {
            $query = $query;
        }
        else 
        {
            $query = $this->adicionarJoins($query, $relacoes);
        }
        return $query->first();
    }

    public function editarComposite(array $dados, $aluno_id, $disciplina_id)
    {
        $recurso = $this->getComposite($aluno_id, $disciplina_id);
        $recurso->update($dados);
    }


    public function apagarComposite(int $aluno_id, int $disciplina_id)
    {
        $recurso = $this->getComposite($aluno_id, $disciplina_id);
        $recurso->delete();
    }
}