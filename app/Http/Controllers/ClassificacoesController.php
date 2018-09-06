<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\IClassificacaoRepositorio;
use App\Interfaces\IAlunoRepositorio;
use App\Interfaces\IDisciplinaRepositorio;


class ClassificacoesController extends Controller
{
    private $classificacaoRepositorio;
    private $alunoRepositorio;
    private $disciplinaRepositorio;

    public function __construct(IClassificacaoRepositorio $classificacaoRepo, IAlunoRepositorio $alunoRepo, IDisciplinaRepositorio $disciplinaRepo)
    {
        $this->classificacaoRepositorio = $classificacaoRepo;
        $this->alunoRepositorio = $alunoRepo;
        $this->disciplinaRepositorio = $disciplinaRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request['disciplina_id'] ?? '1';
        $skip = $request['skip'] ?? 0;
        $take = 10;

        $classificacoes = $this->alunoRepositorio->getAll(['nome', 'asc'],  ['classificacoes' => ['disciplina_id' => $id]], $take, $skip);

        $disciplina = $this->disciplinaRepositorio->get($id);

        $disciplinas = $this->disciplinaRepositorio->getAll();

        return response()->json(['classificacoes' => $classificacoes, 'disciplina' => $disciplina, 'disciplinas' => $disciplinas]);
    }

    /**

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nota' => 'required',
            'aluno_id' => 'required',
            'disciplina_id' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->messages(), 404);
        }
        
        $this->classificacaoRepositorio->criar($request->all());

        return response()->json(['mensagem' => 'ok'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($aluno_id, $disciplina_id)
    {
        $classificacao = $this->classificacaoRepositorio->getComposite($aluno_id, $disciplina_id, ['aluno', 'disciplina']);

        if(!is_null($classificacao))
        {
            return response()->json(['classificacao' => $classificacao], 200);
        }
        return response('', 404);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $aluno_id, $disciplina_id)
    {
        $validator = Validator::make($request->all(), [
            'nota' => 'required',
            'aluno_id' => 'required',
            'disciplina_id' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->messages(), 404);
        }

        $classificacao = $this->classificacaoRepositorio->getComposite($aluno_id, $disciplina_id);
        if(!is_null($classificacao))
        {
            $this->classificacaoRepositorio->editarComposite($request->all(), $aluno_id, $disciplina_id);
            return response(['mensagem' => 'Classificação editada com sucesso!'], 200);
        }
        return response(['mensagem' => 'Ocorreu um erro. Por favor, tente novamente.'], 404);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($aluno_id, $disciplina_id)
    {
        $classificacao = $this->classificacaoRepositorio->getComposite($aluno_id, $disciplina_id);
        if(!is_null($classificacao))
        {
            $this->classificacaoRepositorio->apagarComposite($aluno_id, $disciplina_id);
            return response()->json(['', 200]);
        }
        return response()->json(['', 404]);
    }
}
