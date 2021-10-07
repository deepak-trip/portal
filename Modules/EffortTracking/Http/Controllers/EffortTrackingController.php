<?php

namespace Modules\EffortTracking\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\EffortTracking\Services\EffortTrackingService;
use Modules\Project\Entities\Project;

class EffortTrackingController extends Controller
{
    protected $service;

    public function __construct(EffortTrackingService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     * @param Project $project
     */
    public function index(Project $project)
    {
        return view('efforttracking::index')->with('project', $project);
    }

    /**
     * Show the specified resource.
     * @param Project $project
     */
    public function show(Project $project)
    {
        $data = $this->service->show($project);

        return view('efforttracking::show')->with($data);
    }
}
