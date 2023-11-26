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

if (!function_exists('generateReference')) {
    /**
     * Generate reference for any entity
     *
     */
    function generateReference($length = 6): string
    {

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $reference = '';

        $maxIndex = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = mt_rand(0, $maxIndex);
            $reference .= $characters[$randomIndex];
        }

        $reference .= substr(time(), 0, 3) . str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT);

        return $reference;
    }
}

