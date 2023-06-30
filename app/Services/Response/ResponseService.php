<?php

namespace App\Services\Response;

use Illuminate\Http\JsonResponse;

class ResponseService
{
    private static function responseParams($status, $errors, $data): array
    {
        return [
            'status' => $status,
            'errors' => (object)$errors,
            'data' => (object)$data
        ];
    }

    public static function sendJsonResponse($status, $code = 200, $errors=[], $data=[]): JsonResponse
    {
        return response()->json(self::responseParams($status, $errors, $data), $code);
    }

    public static function success($data=[]): JsonResponse
    {
        return self::sendJsonResponse(true, 200, [], $data);
    }

    public static function notFound($data=[]): JsonResponse
    {
        return self::sendJsonResponse(false, 404, [], []);
    }
}
