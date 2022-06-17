<?php

namespace App\Helpers;

class ResponsesHelpers
{
    public static function getResponseSucces($status, $data)
    {
        return response()->json([
            'status' => $status,
            'data' => $data,
        ]);
    }

    public static function getResponseError($status, $message)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
        ]);
    }
}
