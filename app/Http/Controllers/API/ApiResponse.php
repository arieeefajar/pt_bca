<?php

namespace App\Http\Controllers\Api;

trait ApiResponse
{
    /**
     * @param string $message
     * @param null $data
     * @param int $httpStatusCode
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function singleDataSuccessResponse(string $message, $data = null, int $httpStatusCode = 200)
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $httpStatusCode);
    }

    /**
     * @param string $message
     * @param null $data
     * @param int $httpStatusCode
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function singleDataSuccessSaveResponse(string $message, $data = null, int $httpStatusCode = 201)
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $httpStatusCode);
    }

    /**
     * @param string $message
     * @param array $data
     * @param int $httpStatusCode
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function resourceDataSuccessResponse(string $message, array $data = [], int $httpStatusCode = 200)
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $httpStatusCode);
    }

    /**
     * @param string $message
     * @param mixed $resources
     * @param int $httpStatusCode
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function resourcesDataSuccessResponse(string $message, $resources, int $httpStatusCode = 200)
    {
        return response()->json([
            'message' => $message,
            'data' => [
                'pagination' => [
                    'current_page' => $resources->currentPage(),
                    'last_page' => $resources->lastPage(),
                    'per_page' => $resources->perPage(),
                    'total' => $resources->total(),
                ],
                'data' => $resources->items(),
            ]
        ], $httpStatusCode);
    }

    /**
     * @param string $message
     * @param null $data
     * @param int $httpStatusCode
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse(string $message, $data = null, int $httpStatusCode = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $httpStatusCode);
    }

    /**
     * @param string $message
     * @param mixed $resources
     * @param int $httpStatusCode
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function paginatedSuccessResponse(string $message, $resources, int $httpStatusCode = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => [
                'pagination' => [
                    'current_page' => $resources->currentPage(),
                    'last_page' => $resources->lastPage(),
                    'per_page' => $resources->perPage(),
                    'total' => $resources->total(),
                ],
                'data' => $resources->items(),
            ]
        ], $httpStatusCode);
    }

    /**
     * @param string $message
     * @param null $data
     * @param int $httpStatusCode
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse(string $message, $data = null, int $httpStatusCode = 402): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $httpStatusCode);
    }
}
