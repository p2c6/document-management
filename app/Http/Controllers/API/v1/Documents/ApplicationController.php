<?php

namespace App\Http\Controllers\API\v1\Documents;

use App\Http\Controllers\Controller;
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

    }

    public function delete()
    {

    }
}
