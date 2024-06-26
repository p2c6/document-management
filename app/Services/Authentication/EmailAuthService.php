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
     * The response service instasnce.
     *
     * @var ResponseService
     */
    private $service;

    /**
     * Email Auth Service constructor.
     * 
     * @param $service the instance of ResponseService.
     */
    public function __construct(ResponseService $service) {
        $this->service = $service;
    }

    /**
     * Handle user signup request.
     * 
     * @param \Illuminate\Http\Request $request The HTTP request object containing user data.
     * 
     * @return \Symfony\Component\HttpFoundation\JsonResponse 
     */
    public function signup($request) : JsonResponse
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

    /**
     * Handle user signin request.
     * 
     * @param \Illuminate\Http\Request $request The HTTP request object containing user data.
     * 
     * @return \Symfony\Component\HttpFoundation\JsonResponse 
     */
    public function signin($request) : JsonResponse
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