<?php

namespace App\Http\Controllers;

use App\Services\TemporaryUpload\TemporaryUploadService;
use Illuminate\Http\Request;

class TemporaryFileController extends Controller
{
    /**
     * The temporary upload service instance.
     * 
     * @var TemporaryUploadService
     */
    private $service;

    /**
     * TemporaryFileController constructor.
     * 
     * @param TemporaryService $service The instance of TemporaryUploadService.
     */
    public function __construct(TemporaryUploadService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle temporary file upload.
     * 
     * @param \Illuminate\Http\Request $request The HTTP request object containing upload data.
     * @return mixed|string
     */
    public function upload(Request $request)
    {
        return $this->service->upload($request);
    }

    /**
     * Handle temporary file revert.
     * 
     * @param \Illuminate\Http\Request $request The HTTP request object containing upload data.
     * @return mixed|string
     */
    public function revert(Request $request): mixed
    {
        return $this->service->revert($request);
    }
}
