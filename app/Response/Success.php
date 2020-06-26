<?php

    namespace App\Response;

    use Illuminate\Http\Request;

    class Success
    {
        /**
         * @param $data
         * @param array $codeInternal
         * @param Request|null $request
         * @return \Illuminate\Http\JsonResponse|Mixed
         */
        public function returnType($data, array $codeInternal)
        {
            return response()->json([
                'code'       => $codeInternal["code"],
                'status'     => "success",
                'message'    => $codeInternal["message"],
                'data'       => $data,
            ]);
        }

        /**
         * @param $data
         * @param array $codeInternal
         * @param Request|null $request
         * @return bool|\Illuminate\Http\RedirectResponse|void
         */
        public static function generic($data, array $codeInternal)
        {
            return (new Success)->returnType($data, $codeInternal);
        }

    }
