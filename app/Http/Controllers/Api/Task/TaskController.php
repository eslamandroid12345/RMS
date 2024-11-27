<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\SortTaskRequest;
use App\Http\Requests\Task\SubTaskRequest;
use App\Http\Requests\Task\TaskRequest;
use App\Http\Services\Api\Task\TaskService;
use App\Repository\TaskRepositoryInterface;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(protected TaskService $taskService){
        $this->middleware('permission:tasks-create')->only('store');
        $this->middleware('permission:tasks-delete')->only('destroy');

    }
    public function show($id){
        return $this->taskService->show($id);
    }
    public function store(TaskRequest $request){
        return $this->taskService->store($request);
    }
    public function update($id,TaskRequest $request){
        return $this->taskService->udpate($id,$request);
    }

    public function storeSubTask(SubTaskRequest $request){
        return $this->taskService->storeSubTask($request);
    }
    public function updateSubTask($id,SubTaskRequest $request){
        return $this->taskService->updateSubTask($id,$request);
    }


    public function toggle($id){
        return $this->taskService->toggleStatus($id);
    }

    public function destroy($id){
        return $this->taskService->delete($id);
    }
    public function sort(SortTaskRequest $request){
        return $this->taskService->sort($request);
    }
    public function toDo(){
        return $this->taskService->toDo();
    }
}
