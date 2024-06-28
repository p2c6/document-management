<?php

namespace App\Services\Admin\Role;

use App\Http\Resources\RoleCollection;
use App\Models\Role;
use App\Services\Response\ResponseService;
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
            $role = Role::create([
                'name' => $request->name,
            ]);
            
            return $this->service->response('success', 'Role Created', $role, JsonResponse::HTTP_CREATED);
        } catch (\Throwable $error) {
            return $this->service->response('error', 'Server Error', $error, JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * The list of roles.
     * 
     * @param \App\Models\Application $paginatedModel The paginated role model.
     * 
     * @return \App\Http\Resources\Application\RoleCollection
     * 
     */
    public function index($paginatedModel): RoleCollection
    {
        return new RoleCollection($paginatedModel);
    }
}