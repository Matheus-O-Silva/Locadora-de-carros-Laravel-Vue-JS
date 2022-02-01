<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credenciais = $request->all(['email','password']);
        $token = auth('api')->attempt($credenciais);

        if($token) {
            return response()->json(['message' => 'Usuário autênticado com sucesso', 'token' => $token], 200);
        }

        return response()->json(['message' => 'Erro, Usuário não autênticado'], 403);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Success, Usuário deslogado'], 200);
    }
    public function refresh()
    {
        $token = auth('api')->refresh();
        return response()->json(['message' => 'Success, Token  atualizado', 'token' => $token], 200);
    }
    public function me()
    {
        return response()->json([auth()->user()], 200);
    }
}
