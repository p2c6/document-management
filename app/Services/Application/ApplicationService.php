<?php

namespace App\Services\Application;

use App\Models\Application;
use App\Services\Response\ResponseService;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApplicationService 
{
    /**
    *The response service instance. 
    * 
    * @var ResponseService
    */
    private $service;

    /**
     * ApplicationService constructor.
     *
     * @param ResponseService $service The response service instance.
     */
    public function __construct(ResponseService $service) {
        $this->service = $service;
    }

    /**
     * Store a new application.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing application data.
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function store($request) : JsonResponse
    {
        try {
            $application = Application::create([
                'date_needed' => $request->date_needed,
                'remarks' => $request->remarks,
                'user_id' => Auth::user()->id,
                'status' => Application::SUBMITTED,
            ]);

            return $this->service->response('success', 'Application Submitted!', $application, JsonResponse::HTTP_CREATED);

        } catch (\Throwable $error) {
            return $this->service->response('error', 'Server Error', $error, JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update an application.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing application data.
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function update($application, $request) : JsonResponse
    {
        try {
            $application = $application->update([
                'date_needed' => $request->date_needed,
                'remarks' => $request->remarks,
                'user_id' => Auth::user()->id,
                'status' => Application::RESUBMITTED,
            ]);

            return $this->service->response('success', 'Application Resubmitted!',null, JsonResponse::HTTP_NO_CONTENT);

        } catch (\Throwable $error) {
            return $this->service->response('error', 'Server Error', $error, JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}