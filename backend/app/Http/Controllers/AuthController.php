<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use App\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $input = $request->only('email', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'E-mail ou senha inválido(a)!',
            ], 401);
        }

        try {

            $user = User::where('email', $request->email)->first();

            if (!isset($user)) {
                return response()->json([
                    'success' => false,
                    'data' => null,
                    'message' => 'Usuário inválido!',
                ], 403);
            }

            Auth::login($user);

            return response()->json([
                'success' => true,
                'message' => 'Login efetuado com sucesso!',
                'data' => $jwt_token,
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $ex->getMessage()
            ], 500);
        }


    }

    public function logout(Request $request)
    {
        $api_token = explode('Bearer ', $request->header('authorization'))[1];

        if (empty($api_token)) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Token de API inválido!'
            ], 422);
        }

        try {
            JWTAuth::invalidate($api_token);

            return response()->json([
                'success' => true,
                'message' => 'Usuário deslogado com sucesso!',
                'data' => null
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Erro ao deslogar usuário!'
            ], 500);
        }
    }

    public function getAuthUser(Request $request)
    {
        try {
            $token = explode('Bearer ', $request->header('authorization'))[1];

            $user = JWTAuth::authenticate($token);

            $user->api_token = $token;

            return response()->json([
                'success' => true,
                'message' => 'Usuário encontrado com sucesso!',
                'data' => $user
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao obter dados do usuário!'
            ], 500);
        }
    }
}
