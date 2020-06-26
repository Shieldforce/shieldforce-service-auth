<?php

namespace App\Response;

use Illuminate\Http\Request;

class Error
{
    /**
     * @param $message
     * @param $data
     * @param $codeHTTP
     * @param $codeInternal
     * @return bool|\Illuminate\Http\RedirectResponse|void
     */
    public function returnType($message, $data, $codeHTTP, $codeInternal, Request $request=null)
    {
        if($request["routeType"]=="api")
        {
            return response()->json([
                'code'       => $codeInternal,
                'status'     => "error",
                'message'    => $message,
                'data'       => $data,
                'inputs'     => $request ? $request->all() : null,
            ], $codeHTTP)->throwResponse();
        }
        if($request["routeType"]=="web")
        {
            return back()
                ->withInput()
                ->withErrors($data)
                ->with("error", $message);
        }
        return true;
    }

    /**
     * @param $message
     * @param $data
     * @param $codeHTTP
     * @param $codeInternal
     * @return bool|\Illuminate\Http\RedirectResponse|void
     */
    public static function generic($message, $data, $codeHTTP, $codeInternal,  Request $request=null)
    {
        return (new Error)->returnType($message, $data, $codeHTTP, $codeInternal, $request);
    }

    /**
     * @param null $message
     * @param null $data
     * @param null $codeHTTP
     * @param null $codeInternal
     */
    public static function tokenInvalid(Request $request=null)
    {
        return response()->json([
            'code'       => 5001,
            'status'     => "error",
            'message'    => "Token Inválido",
            'data'       => null,
            'inputs'     => $request ? $request->all() : null,
        ], 400)->throwResponse();
    }

    /**
     * @param null $message
     * @param null $data
     * @param null $codeHTTP
     * @param null $codeInternal
     */
    public static function tokenExpired(Request $request=null)
    {
        return response()->json([
            'code'       => 5002,
            'status'     => "error",
            'message'    => "Token Expirado",
            'data'       => null,
            'inputs'     => $request ? $request->all() : null,
        ], 408)->throwResponse();
    }

    /**
     * @param null $message
     * @param null $data
     * @param null $codeHTTP
     * @param null $codeInternal
     */
    public static function tokenBlackListed(Request $request=null)
    {
        return response()->json([
            'code'       => 5003,
            'status'     => "error",
            'message'    => "Token na Lista Negra",
            'data'       => null,
            'inputs'     => $request ? $request->all() : null,
        ], 403)->throwResponse();
    }

    /**
     * @param null $message
     * @param null $data
     * @param null $codeHTTP
     * @param null $codeInternal
     */
    public static function tokenNotFound(Request $request=null)
    {
        return response()->json([
            'code'       => 5004,
            'status'     => "error",
            'message'    => "Token não existe",
            'data'       => null,
            'inputs'     => $request ? $request->all() : null,
        ], 403)->throwResponse();
    }

    /**
     * @param null $message
     * @param null $data
     * @param null $codeHTTP
     * @param null $codeInternal
     */
    public static function unauthorized(Request $request=null)
    {
        return response()->json([
            'code'       => 5005,
            'status'     => "error",
            'message'    => "Não Autorizado",
            'data'       => null,
            'inputs'     => $request ? $request->all() : null,
        ], 301)->throwResponse();
    }

}
