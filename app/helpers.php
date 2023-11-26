<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\MessageBag;


if (! function_exists('successResponse')) {
    /**
     * Return a standard success json response
     *
     */
    function successResponse(array $data = [], int $code = Response::HTTP_OK) : JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => $data,
            'error'   => null,
            'errors'  => [],
            'extra'   => []
        ], $code);
    }
}

if (! function_exists('errorResponse')) {
    /**
     * Return a standard error json response
     *
     */
    function errorResponse(string $error = null, array $data = [], MessageBag $errors = null, array $trace = [],  int $code = Response::HTTP_BAD_REQUEST) : JsonResponse
    {
        return response()->json([
            'success' => false,
            'data'    => $data,
            'error'   => $error,
            'errors'  => $errors ?? [],
            'trace'   => $trace
        ], $code);


    }
}

