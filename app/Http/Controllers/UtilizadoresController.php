<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Interfaces\IUtilizadorRepositorio;

class UtilizadoresController extends Controller
{
    private $utilizadorRepositorio;


    public function __construct(IUtilizadorRepositorio $utilizadorRepo)
    {
        $this->utilizadorRepositorio = $utilizadorRepo;
    }


    public function login(Request $request)
    {
        $utilizador = $this->utilizadorRepositorio->verificar($request['email']);
        if(!is_null($utilizador))
        {
            $resposta = Hash::check($request['password'], $utilizador->password) ? true : false;
            if($resposta)
            {
                $credenciais = ['email' => $utilizador->email, 'password' => $request['password']];
                $token = JWTAuth::attempt($credenciais);
                return response()->json(['mensagem' => $resposta, 'token' => $token], 200);
            }
            return response()->json(['mensagem' => 'Password incorreta.'], 404);
        }

        return response()->json(['mensagem' => 'Não existe um utilizador registado com o referido endereço de email.'], 404);
    }

    public function logout(Request $request)
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json('', 200);
    }


    public function verificar()
    {
        return response()->json(Auth::check(), 200);
    }
}
