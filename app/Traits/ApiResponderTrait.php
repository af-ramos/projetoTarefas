<?php

namespace App\Traits;

trait ApiResponderTrait
{
    protected function success(array $data, string $message, int $status = 200) {
        return response()->json([
            'success' => true,
            'message' => $message, 
            'data' => $data, 
        ], $status);
    }

    protected function error(array $data, string $message, int $status = 500) {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $data
        ], $status);
    }
}