<?php

namespace App\Http\Controllers\API\v1\Authentication;

use App\Http\Controllers\Controller;
use App\Services\Authentication\EmailAuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    
    public $service;

    public function __construct(EmailAuthService $service)
    {
        $this->service = $service;
    }
    public function signup(Request $request)
    {
        return $this->service->signup($request);
    }

    public function signin(Request $request)
    {
        return $this->service->signin($request);
    }
}
