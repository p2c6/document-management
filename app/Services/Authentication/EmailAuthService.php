<?php

namespace App\Services\Authentication;


use App\Models\User;
use App\Services\Logger\LoggerService;
use App\Services\Response\ResponseService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\JsonResponse;

class EmailAuthService 
{
     /**
     * @var $loggerService
     */
    private $loggerService;

     /**
     * @var $responseService
     */
    private $responseService;

    public function __construct(LoggerService $loggerService, ResponseService $responseService) {
        $this->loggerService = $loggerService;
        $this->responseService = $responseService;
    }

    /**
     * @param $request
     * @return object 
     */
    public function signup($request) : object
    {
        try {
            $user = User::create([
                'email' => $request->email,
                'password' => $request->password,
                'full_name' => $request->full_name,
                'role_id' => $request->role_id,
            ]);

            return response()->json(["status" => "success", "message" => "Account registered!", "data" => $user], JsonResponse::HTTP_CREATED);
        } catch (\Throwable $error) {
            return $this->loggerService->log($error);
        }
    }

    public function signin($request) : object
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
    
            if (!Auth::attempt($credentials)) {
                return response()->json(["status" => "error", "data" => $credentials], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
    
            $request->session()->regenerate();
    
            $user = Auth::user();
    
            return response()->json(["status" => "success", "data" => $user], JsonResponse::HTTP_OK);
        } catch(\Throwable $error) {
            return $this->loggerService->log($error);
            return response()->json(["status" => "success", "data" => $user], JsonResponse::HTTP_OK);
        }
        


    }
}