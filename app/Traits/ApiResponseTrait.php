<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    /**
     * Return a success JSON response.
     *
     * @param mixed $data
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    protected function successResponse(mixed $data = [], string $message = 'Success', int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data ?? new \stdClass(), // تجنب إرجاع null في JSON
        ], $status);
    }

    /**
     * Return an error JSON response.
     *
     * @param string $message
     * @param int $status
     * @param array|null $errors
     * @return JsonResponse
     */
    protected function errorResponse(string $message, int $status = 400, array $errors = null): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors ?? new \stdClass(), // تأكد من أن JSON لا يحتوي على null
        ], $status);
    }
}
