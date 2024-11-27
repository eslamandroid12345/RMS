<?php

namespace App\Http\Services\Api\Task;


use App\Http\Resources\Task\ProjectTaskResource;
use App\Http\Resources\Task\TaskResource;
use App\Http\Resources\Task\ToDoResource;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\TaskRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use function App\catchError;
use function App\delete_model;
use function App\responseFail;
use function App\responseSuccess;
use function App\store_model;
use function App\update_model;

class TaskService
{
    use Responser;

    public function __construct(protected TaskRepositoryInterface $taskRepository,private GetService $getService){}
    public function show($id){
            return $this->getService->handle(ProjectTaskResource::class,$this->taskRepository,'getById',[$id],true);
    }
    public function store($request){
        $data = $request->except('subTasks' , 'members');
        try {
            DB::beginTransaction();
            $task = store_model($this->taskRepository , $data , true);
            $task->members()->attach($request['members'],['created_at'=>now()]);
            foreach ($request['subTasks'] as $subtask){
                $subtask['task_id'] = $task['id'];
                $subtask['project_id'] = $task['project_id'];
                $subtask['deadline'] = $task['deadline'];
                store_model($this->taskRepository , $subtask  , true);
            }
            DB::commit();
            return responseSuccess(message: __('messages.Added Successfully'),data: new TaskResource($task));
        }catch (\Exception $e){
            return catchError($e);
        }
    }

    public function udpate($id,$request){
        $data = $request->except('subTasks' , 'members');
        DB::beginTransaction();
        try {
            $task = update_model($this->taskRepository,$id , $data , true);
            $task->members()->sync($request['members'],['updated_at'=>now()]);
            DB::commit();
            return responseSuccess(message: __('messages.Updated Successfully'),data: new TaskResource($task));
        }catch (\Exception $e){
            DB::rollBack();
            return catchError($e);
        }
    }
    public function storeSubTask($request){
        $data = $request->validated();
        $task = $this->taskRepository->getById($request['task_id']);
        if (!Gate::allows('assignedToTask' , $task))
            return responseFail(403 , __('messages.You Are Not Authorized For This Action'));
        $data['project_id'] = $task['project_id'];
        $data['deadline'] = $task['deadline'];
        $task= store_model($this->taskRepository , $data ,true);
        return responseSuccess(message: __('messages.Added Successfully'),data: new TaskResource($task));

    }
    public function updateSubTask($id,$request){
        $data = $request->validated();
        $task = $this->taskRepository->getById($request['task_id']);
        if (!Gate::allows('assignedToTask' , $task))
            return responseFail(message: "Not Authorized");
        $data['project_id'] = $task['project_id'];
        $data['deadline'] = $task['deadline'];
        $task= update_model($this->taskRepository , $id , $data ,true);
        return responseSuccess(200,__('messages.Updated Successfully'),new TaskResource($task));
    }
    public function toggleStatus($id){
        return update_model($this->taskRepository , $id , ['status' => request('status')]  , false);
    }


    public function delete($id){
        return delete_model($this->taskRepository , $id , []);
    }
    public function sort($request){
            $tasks = $request->validated();
            foreach ($tasks['id'] as $k => $id){
                update_model($this->taskRepository,$id,['sort'=>$k]);
            }
            return $this->responseSuccess(200, __('messages.Updated Successfully'));
    }
    public function toDo(){
        return $this->responseSuccess(200 , __('dashboard.Success') , [
            'total_tasks' => $this->taskRepository->countTasks(),
            'hold_tasks' => $this->taskRepository->countTasks('HOLD'),
            'in_progress' => $this->taskRepository->countTasks("IN PROGRESS"),
            'done_tasks' => $this->taskRepository->countTasks("FINISHED"),
            'tasks' => TaskResource::collection($this->taskRepository->getToDo()),
        ]);
    }
}
