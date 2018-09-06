<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\IAlunoRepositorio;
use App\Interfaces\IDisciplinaRepositorio;

class AlunosController extends Controller
{
    public $alunoRepositorio;
    public $disciplinaRepositorio;

    public function __construct(IAlunoRepositorio $alunoRepo, IDisciplinaRepositorio $disciplinaRepo)
    {
        $this->alunoRepositorio = $alunoRepo;
        $this->disciplinaRepositorio = $disciplinaRepo;
        $this->disciplinaRepositorio = $disciplinaRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $alunos = $this->alunoRepositorio->getAll();

        return response()->json(['alunos' => $alunos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->getErrors(), 404);
        }

        $this->alunoRepositorio->criar($request->except('_token'));

        return response()->json([''], 200);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
