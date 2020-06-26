<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Shieldforce - Service Authorization",
 *      description="Serviço de Autorização e Permissões",
 *      @OA\Contact(
 *          email="alexandre.ferreira@shieldforce.com.br"
 *      ),
 *     @OA\License(
 *         name="MIT",
 *         url="#"
 *     )
 * )
 */

/**
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST_V1,
 *      description="Serve de Authorização e Permissões"
 *  )
 */

/**
 * @OA\SecurityScheme(
 *     type="oauth2",
 *     description="Use a global client_id / client_secret and your username / password combo to obtain a token",
 *     name="Password Based",
 *     in="header",
 *     scheme="https",
 *     securityScheme="Password Based",
 *     @OA\Flow(
 *         flow="password",
 *         authorizationUrl="/oauth/authorize",
 *         tokenUrl="/oauth/token",
 *         refreshUrl="/oauth/token/refresh",
 *         scopes={}
 *     )
 * )
 */

/**
 * @OA\Tag(
 *     name="Autorização e Permissões",
 *     description="API de Autorização e Permissões",
 *     @OA\ExternalDocumentation(
 *         description="GitHub",
 *         url="https://github.com/Shieldforce/shieldforce-service-auth"
 *     )
 * )
 *
 * @OA\ExternalDocumentation(
 *     description="GitHub",
 *     url="https://github.com/Shieldforce/shieldforce-service-auth"
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
