<?php

namespace App\Http\Services\Api\ContractualTeams;

use App\Http\Resources\ContractualTeams\ContractualTeamsResource;
use App\Http\Resources\Project\ProjectDetailsResource;
use App\Http\Resources\Project\ProjectResource;
use App\Http\Resources\Project\ProjectSimpleResource;

use App\Http\Services\Mutual\FileManagerService;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;

use App\Repository\ProjectEstimateRepositoryInterface;
use App\Repository\ProjectEstimateScopeRepositoryInterface;
use App\Repository\ContractualTeamRepositoryInterface;
use Illuminate\Support\Facades\DB;

use function App\catchError;
use function App\delete_model;
use function App\responseSuccess;
use function App\store_model;
use function App\update_model;

class ContractualTeamsService
{
    use Responser;

    public function __construct
    (
        private ProjectEstimateRepositoryInterface $projectEstimateRepository,
        private ProjectEstimateScopeRepositoryInterface $projectEstimateScopeRepository,
        private ContractualTeamRepositoryInterface $contractualTeamRepository,
        private GetService $getService,
        private FileManagerService $fileManager,
    )
    {
    }


    public function index($id)
    {
        return $this->getService->handle(ContractualTeamsResource::class, $this->contractualTeamRepository, 'getAllTeamsForProject', parameters: [$id]);
    }

    public function store($request,$id)
    {
        DB::beginTransaction();
        try
        {
            $data = $request->validated();
            $data['project_estimate_id'] = $id;
            $contractual_team = $this->contractualTeamRepository->create($data);
            DB::commit();
            return $this->responseSuccess(message: __('messages.created successfully'));
        }
        catch (Exception $e)
        {
            DB::rollBack();
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function show($project_id,$id)
    {
        return $this->getService->handle(ContractualTeamsResource::class, $this->contractualTeamRepository, method: 'getById', parameters: [$id], is_instance: true);
    }

    public function update($project_id,$id, $request)
    {
        try
        {
            $contractual_team = $this->contractualTeamRepository->getById($id);
            $data = $request->validated();
            $data['project_estimate_id'] = $project_id;
            $this->contractualTeamRepository->update($contractual_team->id, $data);
            return $this->responseSuccess(message: __('messages.updated successfully'));
        }
        catch (\Exception $e)
        {
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function delete($project_id,$id)
    {
        try
        {
            $this->contractualTeamRepository->delete($id);
            return $this->responseSuccess(message: __('messages.deleted successfully'));
        }
        catch (\Exception $e)
        {
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

}
