<?php

namespace App\Services\Response;

use App\Services\Logger\LoggerService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\JsonResponse;

class ResponseService 
{
    /**
     * Handles the response for the given request.
     *
     * @param string $status The status of the response.
     * @param string|null $message The message for the response.
     * @param mixed $data The data to include in the response.
     * @param int $response The HTTP status code for the response.
     * 
     * @return JsonResponse 
     */
    public function response(string $status, ?string $message, $data, int $response): JsonResponse
    {
        if ($status === "error")  {
            if (!is_null($data)) {
                $service = new LoggerService();
                $service->logError($data);
            }

            return response()->json(["status" => $status, "message" => $message], $response);
        }

        return response()->json(["status" => $status, "message" => $message, "data" => $data], $response);
    }
}
