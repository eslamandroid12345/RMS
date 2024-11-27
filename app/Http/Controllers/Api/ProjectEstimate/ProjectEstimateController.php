<?php

namespace App\Http\Controllers\Api\ProjectEstimate;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectEstimate\ProjectEstimateRequest;
use App\Http\Requests\ProjectEstimate\StoreScopeRequest;
use App\Http\Resources\ProjectEstimate\ProjectResource;
use App\Http\Services\Api\ProjectEstimate\ProjectEstimateService;
use App\Http\Services\Mutual\GetService;
use Illuminate\Http\Request;

class ProjectEstimateController extends Controller
{
    public function __construct(private ProjectEstimateService $projectEstimateService)
    {
        $this->middleware('permission:project_estimate-read')->only('index');
        $this->middleware('permission:project_estimate-create')->only('store');
        $this->middleware('permission:project_estimate-update')->only('update');
        $this->middleware('permission:project_estimate-delete')->only('destroy');
    }

    public function index()
    {
        return $this->projectEstimateService->index();
    }

    public function show($id)
    {
        return $this->projectEstimateService->show($id);
    }

    public function deleteScope($id)
    {
        return $this->projectEstimateService->deleteScope($id);
    }

    public function storeScope(StoreScopeRequest $request,$id)
    {
        return $this->projectEstimateService->storeScope($request,$id);
    }

    public function store(ProjectEstimateRequest $request)
    {
        return $this->projectEstimateService->store($request);
    }

    public function update($id , ProjectEstimateRequest $request)
    {
        return $this->projectEstimateService->update($id , $request);
    }

    public function destroy($id)
    {
        return $this->projectEstimateService->delete($id);
    }

}
