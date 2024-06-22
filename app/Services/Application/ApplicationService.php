<?php

namespace App\Services\Application;


use App\Models\User;
use App\Services\Logger\LoggerService;
use App\Services\Response\ResponseService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApplicationService 
{
     /**
     * @var $service
     */
    private $service;

    public function __construct(ResponseService $service) {
        $this->service = $service;
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

            return $this->service->response('success', 'Account registered!', $user, JsonResponse::HTTP_CREATED);

        } catch (\Throwable $error) {
            return $this->service->response('error', 'Server Error', $error, JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
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
                return $this->service->response('error', 'Invalid Credentials', null, JsonResponse::HTTP_UNAUTHORIZED);
            }
    
            $request->session()->regenerate();
    
            $user = Auth::user();
    
            return $this->service->response('success', null, $user, JsonResponse::HTTP_OK);

        } catch(\Throwable $error) {
            return $this->service->response('error', 'Server Error', $error, JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}