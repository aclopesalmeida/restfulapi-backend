<?php

namespace App\Interfaces;

interface IGenericoRepositorio 
{
    function get(int $id, array $relacoes = null);
    function getAll(array $ordem = null, array $relacoes = null, int $take = null, int $skip = null);
    function criar(array $dados);
    function editar(int $id, array $dados);
    function apagar(int $id);

}