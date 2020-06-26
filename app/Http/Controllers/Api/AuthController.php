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
     * @OA\POST(
     *      path="/auth/login",
     *      operationId="login",
     *      tags={"Atenticação"},
     *      summary="Endpoint de Login",
     *      description="Acesso de usuários do sistema",
     *     @OA\Parameter(
     *          name="email",
     *          description="E-mail de Acesso",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string",
     *              format="email"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="password",
     *          description="Senha de Acesso",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string",
     *              format="password"
     *          )
     *      ),
     *      @OA\Response(
     *          response=10000,
     *          description="Logado com sucesso!"
     *       ),
     *       @OA\Response(response=4001, description="Erro de Validação de Campos"),
     *       @OA\Response(response=5005, description="Não Autorizado")
     *     )
     *
     * Requisição para Acesso ao Sistema
     */
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email'        => ['required'],
            'password'     => ['required'],
        ]);

        if($validation->fails())
        {
            return Error::generic($validation->errors(), messageErrors(4000));
        }

        $credentials = $request->only(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {

            return Error::generic(null, messageErrors(5004));
        }

        return $this->respondWithToken($token);
    }

    /**
     * @OA\POST(
     *      path="/auth/me",
     *      operationId="me",
     *      tags={"Atenticação"},
     *      summary="Endpoint de Informações de usuário",
     *      description="Mostra dados do Usuário logado!",
     *      @OA\Parameter(
     *          name="Authorization",
     *          description="Token de Autorização",
     *          required=true,
     *          in="header",
     *          @OA\Schema(
     *              type="string",
     *              format="text"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Sucesso em ver dados de usuário!"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "oauth2_security_example": {"write:projects", "read:projects"}
     *         }
     *     },
     * )
     */
    public function me()
    {
        $data = auth('api')->user();
        if($data)
        {
            return Success::generic($data, messageSuccess(10002));
        }
        return Error::generic(null, messageErrors(1003, "Usuário"));
    }

    /**
     * @return bool|\Illuminate\Http\RedirectResponse|void
     */
    public function logout()
    {
        auth('api')->logout();
        return Success::generic(null, messageSuccess(10001));
    }

    /**
     * Refresh a token.
     *
     * @return bool|\Illuminate\Http\RedirectResponse|void
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
     * @return bool|\Illuminate\Http\RedirectResponse|void
     */
    protected function respondWithToken($token)
    {
        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ];
        return Success::generic($data, messageSuccess(10000));
    }
}
