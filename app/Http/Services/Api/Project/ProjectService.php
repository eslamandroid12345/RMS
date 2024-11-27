<?php

namespace App\Http\Services\Api\Project;

use App\Http\Resources\Project\ProjectAsigneeResource;
use App\Http\Resources\Project\ProjectDetailsResource;
use App\Http\Resources\Project\ProjectResource;
use App\Http\Resources\Project\ProjectSimpleResource;
use App\Http\Services\Mutual\FileManagerService;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Jobs\SortProjectsJob;
use App\Repository\LinkRepositoryInterface;
use App\Repository\ProjectRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\catchError;
use function App\delete_model;
use function App\responseSuccess;
use function App\store_model;
use function App\update_model;

class ProjectService
{
    use Responser;

    public function __construct(private ProjectRepositoryInterface $projectRepository, private GetService $get, private FileManagerService $fileManager
        , private LinkRepositoryInterface                          $linkRepository, private UserRepositoryInterface $userRepository)
    {
    }


    public function getProjects()
    {
        $projects = $this->projectRepository->getProjects();
        $data = [
            'HOLD' => ProjectResource::collection($projects->where('status', 'HOLD')),
            'IN_PROGRESS' => ProjectResource::collection($projects->where('status', 'IN_PROGRESS')),
            'FINISHED' => ProjectResource::collection($projects->where('status', 'FINISHED')),
        ];
        return responseSuccess(data: $data);
    }

    public function assignedProjects()
    {
        $projects = auth('api')->user()->projects;
        return $this->responseSuccess(data: ProjectSimpleResource::collection($projects));
    }

    public function getAsignee($id)
    {
        $membersOnProject = $this->projectRepository->getAsignee($id);
        $members = $this->userRepository->getAllMembers();
        $members->map(function ($member) use ($membersOnProject) {
            if (in_array($member->id, $membersOnProject)) {
                $member->inProject = true;
            } else {
                $member->inProject = false;
            }
        });
        return $this->responseSuccess(200, __('Success'), ProjectAsigneeResource::collection($members));
    }

    public function getProjectDetails($id)
    {
        $project = $this->projectRepository->getById($id);
        $project->tasksProgress = $this->projectRepository->tasksProgress($project);
        return $this->responseSuccess(200, __('dashboard.Success'), ProjectDetailsResource::make($project));
//        return $this->get->handle(ProjectDetailsResource::class , $this->projectRepository , 'getById' , [$id] , true);
    }

    public function store($request)
    {
        $data = $request->except('members', 'link');
        $data['created_by'] = auth('api')->id();
        try {
            DB::beginTransaction();
            if ($request->image !== null) {
                $data['image'] = $this->fileManager->handle('image', 'projects/images');
            }
            $lastSort = $this->projectRepository->getAll()->where('status', 'HOLD')->max('sort');
            $data['sort'] = $lastSort + 1;
            $project = store_model($this->projectRepository, $data, returnModel: true);
            $project->members()->attach($request['members']);
            if ($request['link']) {
                $this->storeLinks($project, $request['link']);
            }
            DB::commit();
            return responseSuccess(message: __('messages.Added Successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            catchError($e);
        }

    }

    private function storeLinks($project, $link)
    {
        $link['created_by'] = $project->created_by;
        $link['project_id'] = $project->id;
        store_model($this->linkRepository, $link, false);
    }

    public function update($id, $request)
    {
        $data = $request->except('members');
        try {
            DB::beginTransaction();
            if ($request->image !== null) {
                $data['image'] = $this->fileManager->handle('image', 'projects/images');
            }
            $project = update_model($this->projectRepository, $id, $data, returnModel: true);
            if (request()->has('members'))
                $project->members()->sync($request['members']);
            DB::commit();
            return responseSuccess(message: __('messages.Updated Successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            catchError($e);
        }

    }

    public function delete($id)
    {
        return delete_model($this->projectRepository, $id);
    }

    public function toggleStatus($id)
    {
        return update_model($this->projectRepository, $id, ['status' => request('status')], false);
    }

    public function sort($request)
    {
        $data = $request->validated();
        SortProjectsJob::dispatch($data, $this->projectRepository);
        return $this->responseSuccess(200, __('messages.Updated Successfully'));
    }

}
