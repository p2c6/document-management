<?php

namespace App\Http\Controllers\API\v1\Documents;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * @var $service ApplicationService
     */
    private $service;

    public function __construct()
    {
        
    }

    public function store(Request $request)
    {
    }

    public function update(Application $application, Request $request)
    {

    }

    public function delete()
    {

    }
}
