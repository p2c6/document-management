<?php

namespace App\Http\Controllers\API\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleCollection;
use App\Models\Role;
use App\Services\Admin\Role\RoleService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class RoleController extends Controller
{
    /**
     * The role service instance.
     * 
     * @var RoleService
     */
    public $service;

    /**
     * RoleController constructor.
     * 
     * @param RoleService $service The instance of RoleService.
     */
    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }

    /**
     * List of all roles.
     * 
     * @return \App\Http\Resources\RoleCollection
     */
    public function index(): RoleCollection
    {
        return $this->service->index(Role::paginate());
    }

    /**
     * Store a new role.
     * 
     * @param \Illuminate\Http\Request $request The HTTP request object containing role data.
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        // $this->authorize('create-role');
        
        return $this->service->store($request);
    }
}
