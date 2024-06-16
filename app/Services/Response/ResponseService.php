<?php

namespace App\Services\Response;

use App\Models\Roles;
use App\Models\User;
use App\Services\Logger\LoggerService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\JsonResponse;

class ResponseService 
{
    /**
     * @param string $request
     * @param string $message
     * @param object $data
     * @param JsonResponse $response
     * 
     * @return object 
     */
    public function response($status, $message = null, $data = null, $response) : object
    {
        if ($status === "error")  {
            
            if (!is_null($data)) {
                $service = new LoggerService();
                $service->logError($data);
            }

            return response()->json(["status" => $status, "message" => $message, ], $response);
        }

        return response()->json(["status" => $status, "message" => $message, "data" => $data], $response);
    }
}