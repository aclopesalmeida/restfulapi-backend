<?php

namespace App\Interfaces;

interface IClassificacaoRepositorio extends IGenericoRepositorio
{
    function getComposite(int $aluno_id, int $disciplina_id, array $relacoes = null);
    function editarComposite(array $dados, $aluno_id, $disciplina_id);
    function apagarComposite(int $aluno_id, int $disciplina_id);
}