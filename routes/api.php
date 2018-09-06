<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::group(['middleware' => ['jwt.auth', 'cors']], function() {

    Route::post('/classificacoes/', [
        'uses' => 'ClassificacoesController@store'
    ]);
    
    Route::resource('/disciplinas', 'DisciplinasController')->except('index');
    Route::resource('/alunos', 'AlunosController')->except('index');

    Route::post('/utilizadores/logout', [
        'uses' => 'UtilizadoresController@logout',
        'as' => 'logout'
    ]); 
   
});


Route::get('/classificacoes/{disciplina_id?}', [
    'uses' => 'ClassificacoesController@index',
    'middleware' => ['cors']
]);

Route::get('/alunos', [
    'uses' => 'AlunosController@index'
]);
Route::get('/disciplinas', [
    'uses' => 'DisciplinasController@index'
]);
Route::post('/utilizadores/login', [
    'uses' => 'UtilizadoresController@login',
    'as' => 'login',
    'middleware' => 'cors'
]); 
Route::get('/utilizadores/verificar', [
    'uses' => 'UtilizadoresController@verificar',
    'middleware' => 'cors'
]); 

Route::get('/classificacoes/{aluno_id}/{disciplina_id}', [
    'uses' => 'ClassificacoesController@show',
    'middleware' => 'cors'
]);
Route::put('/classificacoes/{aluno_id}/{disciplina_id}/editar', [
    'uses' => 'ClassificacoesController@update',
    'middleware' => 'cors'
]);
Route::delete('/classificacoes/{aluno_id}/{disciplina_id}/apagar', [
    'uses' => 'ClassificacoesController@destroy',
    'middleware' => 'cors'
]);
