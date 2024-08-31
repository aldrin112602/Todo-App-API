<?php

namespace App\Http\Controllers;
use Exception;

abstract class Controller
{
    public function handleException(Exception $e, $defaultMessage)
    {
        if ($e instanceof ValidationException) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        if ($e instanceof ModelNotFoundException) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        return response()->json(['error' => $defaultMessage, 'message' => $e->getMessage()], 500);
    }
}
