<?php

namespace App\Services\Admin\Role;

use App\Models\Roles;
use App\Models\User;
use App\Services\Logger\LoggerService;
use App\Services\Response\ResponseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\JsonResponse;

class RoleService 
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
    public function store($request) : object
    {
        try {
            $role = Roles::create([
                'name' => $request->name,
            ]);
            
            return $this->service->response('success', 'Role Created', $role, JsonResponse::HTTP_CREATED);
        } catch (\Throwable $error) {
            return $this->service->response('error', 'Server Error', $error, JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}