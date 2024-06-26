<?php

namespace App\Services\Application;

use App\Http\Resources\Application\ApplicationCollection;
use App\Http\Resources\Application\ApplicationResource;
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
     * @param ResponseService $service The instance of ResponseService.
     */
    public function __construct(ResponseService $service) {
        $this->service = $service;
    }

    /**
     * The list of applications.
     * 
     * @param \App\Models\Application $paginatedModel The paginated application model.
     * 
     * @return \App\Http\Resources\Application\ApplicationCollection
     * 
     */
    public function index($paginatedModel): ApplicationCollection
    {
        return new ApplicationCollection($paginatedModel);
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
        return new ApplicationResource(Application::findOrFail($id));
    }

    /**
     * Store a new application.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing application data.
     * 
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
     * @param \App\Models\Application $application The application model.
     * 
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