<?php

namespace App\Http\Controllers\API\v1\Authentication;

use App\Http\Controllers\Controller;
use App\Services\Authentication\EmailAuthService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    /**
     * The email authentication service instance.
     *
     * @var EmailAuthService
     */
    public $service;

    /**
     * Class constructor.
     *
     * @param EmailAuthService $service The instance of EmailAuthService.
     */
    public function __construct(EmailAuthService $service)
    {
        $this->service = $service;
    }
    
    /**
     * Handle user signup request.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing signup data.
     * @return \Symfony\Component\HttpFoundation\JsonResponse 
     */
    public function signup(Request $request): JsonResponse
    {
        return $this->service->signup($request);
    }

    /**
     * Handle user sign-in request.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing sign-in data.
     * @return \Illuminate\Http\Response
     */
    public function signin(Request $request): JsonResponse
    {
        return $this->service->signin($request);
    }
}
