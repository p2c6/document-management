<?php

namespace App\Http\Controllers\API\v1\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\Role\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public $service;

    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }

    public function store(Request $request)
    {
        // $this->authorize('create-role');
        
        return $this->service->store($request);
    }
}
