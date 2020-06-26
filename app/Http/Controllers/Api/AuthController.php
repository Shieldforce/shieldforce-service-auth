<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Response\Error;
use App\Response\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse|Mixed
     */
    public function login(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'email'        => ['required'],
            'password'     => ['required'],
        ]);

        if($validation->fails())
        {
            return Error::generic("Erro de validação de campos", $validation->errors(), 400, 4001, $request);
        }

        $credentials = $request->only(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {

            return Error::unauthorized($request);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $data = auth('api')->user();
        return Success::generic("Dados do retornados", $data, 200);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();
        return Success::generic("Deslogado com sucesso",null,200);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ];

        return Success::generic("Logado com Sucesso", $data,200);
    }
}
