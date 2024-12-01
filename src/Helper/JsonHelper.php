<?php

namespace App\Helper;

use Symfony\Component\HttpFoundation\JsonResponse;

class JsonHelper
{
    /**
     * Return a JSON response with a standard format for success.
     *
     * @param mixed  $data      The data to return in the response.
     * @param string $message   The success message (default is 'Success').
     * @param int    $status    The HTTP status code (default is 200).
     * @param array  $headers   Optional additional headers.
     *
     * @return JsonResponse
     */
    public static function success($data = null, string $message = 'Success', int $status = 200, array $headers = []): JsonResponse
    {
        $response = [
            'status'  => 'success',
            'code'    => $status,
            'message' => $message,
        ];
        if ($data !== null) {
            $response['data'] = $data;
        }
        return new JsonResponse($response, $status, $headers);
    }

    /**
     * Return a JSON response with a standard format for errors.
     *
     * @param string $message   The error message (default is 'Error').
     * @param int    $status    The HTTP status code (default is 400).
     * @param array  $headers   Optional additional headers.
     *
     * @return JsonResponse
     */
    public static function createErrorResponse(string $message = 'Error', int $status = 400, array $headers = []): JsonResponse
    {
        $response = [
            'status'  => 'error',
            'code'    => $status,
            'message' => $message,
        ];
        return new JsonResponse($response, $status, $headers);
    }
}
