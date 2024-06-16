<?php

namespace App\Services\Logger;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class LoggerService 
{
    /**
     * @param \Throwable $error
     * @return void
     */
    public function logError($error)
    {
        Log::error("Error found in {$error->getFile()} at line {$error->getLine()}: {$error->getMessage()}");
    }
}