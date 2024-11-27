<?php

namespace App\Http\Controllers\Api\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\ProjectRequest;
use App\Http\Requests\Project\SortProjectRequest;
use App\Http\Resources\Project\ProjectResource;
use App\Http\Services\Api\Project\ProjectService;
use App\Http\Services\Mutual\GetService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(private ProjectService $projectService){
        $this->middleware('permission:projects-create')->only('store');
        $this->middleware('permission:projects-update')->only('update');
        $this->middleware('permission:projects-delete')->only('destroy');
    }

    public function index(){
        return $this->projectService->getProjects();
    }
    public function assignedProjects(){
        return $this->projectService->assignedProjects();
    }

    public function show($id){
        return $this->projectService->getProjectDetails($id);
    }

    public function store(ProjectRequest $request){
        return $this->projectService->store($request);
    }

    public function update($id , ProjectRequest $request){
        return $this->projectService->update($id , $request);
    }

    public function destroy($id){
        return $this->projectService->delete($id);
    }
    public function toggleStatus($id){
        return $this->projectService->toggleStatus($id);
    }
    public function sort(SortProjectRequest $request){
            return $this->projectService->sort($request);
    }
    public function getAsignee($id){
        return $this->projectService->getAsignee($id);
    }
}
