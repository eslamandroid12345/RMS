<?php

namespace App\Http\Services\Api\ProjectEstimate;

use App\Http\Resources\ProjectEstimate\ProjectEstimateResource;
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

class ProjectEstimateService
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


    public function index()
    {
        return $this->getService->handle(ProjectEstimateResource::class, $this->projectEstimateRepository, 'getAllProjectsEstimates');
    }

    public function store($request)
    {
        DB::beginTransaction();
        try
        {
            $data = $request->except('scopes');
            $data['user_id'] = auth('api')->id();
            $project_estimate = $this->projectEstimateRepository->create($data);
            $this->storeScopes($request->scopes, $project_estimate);
            DB::commit();
            return $this->responseSuccess(message: __('messages.created successfully'));
        }
        catch (Exception $e)
        {
            DB::rollBack();
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    protected function storeScopes($scopes, $project_estimate): void
    {
        if ($scopes)
        {
            foreach ($scopes as $index => $image)
            {
                $newImage = $this->fileManager->handle("scopes.$index", "project_estimate/images");
                $this->projectEstimateScopeRepository->create(['image' => $newImage, 'project_estimate_id' => $project_estimate->id]);
            }
        }
    }

    public function show($id)
    {
        return $this->getService->handle(ProjectEstimateResource::class, $this->projectEstimateRepository, method: 'getById', parameters: [$id], is_instance: true);
    }

    public function storeScope($request,$id)
    {
        try
        {
            $newImage = $this->fileManager->handle("image", "project_estimate/images");
            $this->projectEstimateScopeRepository->create(['image' => $newImage , 'project_estimate_id' => $id]);
            return $this->responseSuccess(message: __('messages.created successfully'));
        }
        catch (\Exception $e)
        {
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function deleteScope($id)
    {
        try
        {
            $this->projectEstimateScopeRepository->delete($id);
            return $this->responseSuccess(message: __('messages.deleted successfully'));
        }
        catch (\Exception $e)
        {
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function update($id, $request)
    {
        try
        {
            $project_estimate = $this->projectEstimateRepository->getById($id);
            $data = $request->validated();
            $data['user_id'] = auth('api')->id();
            $this->projectEstimateRepository->update($project_estimate->id, $data);
            return $this->responseSuccess(message: __('messages.updated successfully'));
        }
        catch (\Exception $e)
        {
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function delete($id)
    {
        try
        {
            $this->projectEstimateRepository->delete($id);
            return $this->responseSuccess(message: __('messages.deleted successfully'));
        }
        catch (\Exception $e)
        {
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

}
