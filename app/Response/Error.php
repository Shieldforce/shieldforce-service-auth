<?php

namespace App\Response;

use Illuminate\Http\Request;

class Error
{
    /**
     * @param $data
     * @param array $codeInternal
     * @param Request|null $request
     * @return bool|\Illuminate\Http\RedirectResponse|void
     */
    public function returnType($data, array $codeInternal)
    {
        return response()->json([
            'code'       => $codeInternal["code"],
            'status'     => "error",
            'message'    => $codeInternal["message"],
            'data'       => $data,
        ])->throwResponse();
    }

    /**
     * @param $data
     * @param array $codeInternal
     * @param Request|null $request
     * @return bool|\Illuminate\Http\RedirectResponse|void
     */
    public static function generic($data, array $codeInternal)
    {
        return (new Error)->returnType($data, $codeInternal);
    }

}
