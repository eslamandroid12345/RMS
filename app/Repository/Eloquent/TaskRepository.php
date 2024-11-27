<?php

namespace App\Repository\Eloquent;


use App\Models\Event;
use App\Models\Task;
use App\Repository\EventRepositoryInterface;
use App\Repository\TaskRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TaskRepository extends Repository implements TaskRepositoryInterface {

    protected Model $model;

    public function __construct(Task $model){
        parent::__construct($model);
    }

    public function prepareToDo(){

        return $this->model::query()->where('task_id',null)->where(function ($query) {
            if(!auth()->user()->hasPermission('tasks-read')){
                $query->whereHas('members' , function ($q){
                    $q->where('user_id' , auth()->id());
                });
            }

            if (\request()->has('team_id')){
                $query->where('team_id',request('team_id'));
            }

            if (\request()->has('date')){
                if (request('date') == 0){
                    $query->where('created_at' ,'>' ,Carbon::now()->subMonth());
                }else if (request('date') == 1){
                    $query->where('created_at' , '>',Carbon::now()->subMonths(3));
                }else if (request('date') == 2){
                    $query->where('created_at' ,'>',Carbon::now()->subMonths(6));
                }
            }

            if(request('status')&&request('status')!='ALL'){
                $query->where('status',request('status'));
            }
        });
    }

    public function getToDo(){
        return $this->prepareToDo()->get();
    }

    public function countTasks($status = null){
        return $this->prepareToDo()->when($status , function ($q) use ($status){
           $q->where('status' , $status);
        })->count();
    }
}
