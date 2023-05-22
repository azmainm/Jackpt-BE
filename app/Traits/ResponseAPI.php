<?php

namespace App\Traits;

use App\Constants\ResponseMessages;
use Illuminate\Http\JsonResponse;

trait ResponseAPI
{
    public function success(string|array $message = ResponseMessages::SUCCESS, array|object $data = [], int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'status' => $statusCode,
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    public function error(string|array $message = 'Something went wrong!', int $statusCode = 500): JsonResponse
    {
        return response()->json([
            'status' => $statusCode,
            'success' => false,
            'error' => $message,
        ], $statusCode);
    }
}
