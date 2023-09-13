<?php

namespace App\Helpers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\MessageBag;

class ResponseHelper
{
    public static function success(array|LengthAwarePaginator|Model|null $data, string $message = 'OK', int $code = 200): JsonResponse
    {
        $payload = [
            'meta' => [
                'status' => 'success',
                'code' => $code,
                'message' => $message,
            ],
            'data' => $data,
        ];

        return response()->json($payload, $code);
    }

    public static function error(array|LengthAwarePaginator|Model|null $data, string $message = 'ERR', int $code = 400): JsonResponse
    {
        $payload = [
            'meta' => [
                'status' => 'error',
                'code' => $code,
                'message' => $message,
            ],
            'data' => $data,
        ];

        return response()->json($payload, $code);
    }

    public static function failedValidation(MessageBag $data, string $message = 'VALIDATION ERR', int $code = 422): JsonResponse
    {
        $payload = [
            'meta' => [
                'status' => 'error',
                'code' => $code,
                'message' => $message,
            ],
            'data' => $data,
        ];

        return response()->json($payload, $code);
    }

    public static function notFound(string $message = 'ERR', int $code = 404): JsonResponse
    {
        $payload = [
            'meta' => [
                'status' => 'error',
                'code' => $code,
                'message' => $message,
            ],
            'data' => null,
        ];

        return response()->json($payload, $code);
    }
}
