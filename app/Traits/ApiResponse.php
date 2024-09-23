<?php

namespace App\Traits;

trait ApiResponse 
{
    protected function success($message = null, $data = null, $code = 200) {
        $res = [
            'status'    => 'success',
            'message'   => $message,
        ];

        if ($data) {
            $res['data'] = $data;
        }

        return response()->json($res, $code);
    }

    protected function error($message = null, $code = 400) {
        return response()->json([
            'status'    => 'error',
            'message'   => $message
        ], $code);
    }
}
