<?php

namespace App\Http\Controllers\API\v1\Documents;

use App\Http\Controllers\Controller;
use App\Http\Resources\Application\ApplicationCollection;
use App\Http\Resources\Application\ApplicationResource;
use App\Models\Application;
use App\Services\Application\ApplicationService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApplicationController extends Controller
{
    /**
    * The application service instance.
    * 
    * @var ApplicationService
    */
    private $service;

    /**
     * ApplicationController contructor.
     * 
     * @param ApplicationService $service The instance of ApplicationService.
     */
    public function __construct(ApplicationService $service)
    {
        $this->service = $service;
    }

    /**
     * List of all applications.
     * 
     * @return \App\Http\Resources\ApplicationCollection
     */
    public function index(): ApplicationCollection
    {
        return $this->service->index(Application::paginate());
    }

    /**
     * Show specific application.
     * 
     * @param int $id The id of the application.
     * 
     * @return \App\Http\Resources\ApplicationResource
     */
    public function show(int $id): ApplicationResource
    {
        return $this->service->show($id);
    }

    /**
     * Store a new application.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing application data.
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        return $this->service->store($request);
    }

    public function update(Application $application, Request $request)
    {
        return $this->service->update($application, $request);
    }

    public function delete()
    {

    }
}
