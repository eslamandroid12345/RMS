<?php

namespace App\Http\Controllers\Api\ContractualTeams;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectEstimate\ProjectEstimateRequest;
use App\Http\Requests\ContractualTeams\ContractualTeamsRequest;
use App\Http\Resources\ProjectEstimate\ProjectResource;
use App\Http\Services\Api\ContractualTeams\ContractualTeamsService;
use App\Http\Services\Mutual\GetService;
use Illuminate\Http\Request;

class ContractualTeamsController extends Controller
{
    public function __construct(private ContractualTeamsService $contractualTeamsService)
    {
        // $this->middleware('permission:projects-create')->only('store');
        // $this->middleware('permission:projects-update')->only('update');
        // $this->middleware('permission:projects-delete')->only('destroy');
    }

    public function index($id)
    {
        return $this->contractualTeamsService->index($id);
    }

    public function show($project_id,$id)
    {
        return $this->contractualTeamsService->show($project_id,$id);
    }


    public function store(ContractualTeamsRequest $request,$id)
    {
        return $this->contractualTeamsService->store($request,$id);
    }

    public function update($project_id,$id , ContractualTeamsRequest $request)
    {
        return $this->contractualTeamsService->update($project_id,$id , $request);
    }

    public function destroy($project_id,$id)
    {
        return $this->contractualTeamsService->delete($project_id,$id);
    }

}
