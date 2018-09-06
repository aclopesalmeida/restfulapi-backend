<?php
namespace App\Repositorios;

use Illuminate\Database\Eloquent\Model;
use App\Interfaces\IGenericoRepositorio;

class GenericoRepositorio implements IGenericoRepositorio
{
    protected $modelo;

    public function __construct($modelo)
    {
        $this->modelo = $modelo;
    }

    public function adicionarJoins($query, array $relacoes)
    {   
        /* ['alunos' => ['idade' => '20']] */
        foreach($relacoes as $key => $value) 
        {
            if(!is_array($value))
            {
                $query = $query->with($value);
            }
            else
            { 
                /* ex: disciplinas => [id => 1] */
                foreach($value as $k => $v)
                {
                    $query = $query->with([$key => function($q) use($k,$v) {
                        $q->where($k, $v);
                    }])->whereHas($key, function($q) use($k,$v) {
                        $q->where($k, $v);
                    });
                }
                
            } 
        }
        return $query;
    }

    public function get(int $id, array $relacoes = null)
    {
        $query = $this->modelo->where('id', $id);
        if(is_null($relacoes)) {
            $query = $query;
        }
        else 
        {
            $query = $this->adicionarJoins($query, $relacoes);
        }
        return $query->first();
    }

    public function getAll(array $ordem = null, array $relacoes = null, int $take = null, int $skip = null)
    {
        $ordem = $ordem ?? ['id', 'asc'];
        $skip = $skip ?? 0;
        $query = $this->modelo;

        if(is_null($relacoes))
        {
            $query = $query;
        } 
        else {
            $query = $this->adicionarJoins($query, $relacoes);
        }
        
        if(!is_null($take))
        {
            $query = $query->skip($skip)->take($take);
        }

        $query = is_null($ordem) ? $query->get() : $query->orderBy($ordem[0], $ordem[1])->get();
        return $query;
    }

    public function criar(array $dados)
    {
        $recurso = $this->modelo->create($dados);
    }

    public function editar(int $id, array $dados)
    {
        $recurso = $this->modelo->find($id);
        $recurso->update($dados);
    }

    public function apagar(int $id)
    {
        $this->modelo->find($id)->delete();
    }
}