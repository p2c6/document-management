<?php

namespace App\Http\Controllers\API\v1\Authentication;

use App\Http\Controllers\Controller;
use App\Services\Authentication\EmailAuthService;
use Illuminate\Http\Request;

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
     * @param EmailAuthService $service The email authentication service instance.
     */
    public function __construct(EmailAuthService $service)
    {
        $this->service = $service;
    }
    
    /**
     * Handle user signup request.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing signup data.
     * @return \Illuminate\Http\Response
     */
    public function signup(Request $request)
    {
        return $this->service->signup($request);
    }

    /**
     * Handle user sign-in request.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing sign-in data.
     * @return \Illuminate\Http\Response
     */
    public function signin(Request $request)
    {
        return $this->service->signin($request);
    }
}
