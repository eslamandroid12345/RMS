<?php

namespace App\Repository\Eloquent;

use App\Http\Traits\FileManager;
use App\Models\Project;
use App\Models\Report;
use App\Models\Team;
use App\Models\User;
use App\Repository\ProjectRepositoryInterface;
use App\Repository\ReportRepositoryInterface;
use App\Repository\RepositoryInterface;
use App\Repository\TeamRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Carbon\Carbon;
use Closure;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProjectRepository extends Repository implements ProjectRepositoryInterface {

    protected Model $model;

    public function __construct(Project $model){
        parent::__construct($model);
    }
    public function getProjects(){
        $query=$this->model::query();
        if(request('status')){
            $query->where('status',request('status'));
        }
        if (\request()->has('team_id') && \request('team_id') != "ALL"){
            $query->whereHas('tasks',function ($query){
                $query->whereIn('status',['HOLD','IN PROGRESS'])
                    ->where('task_id',null)
                    ->where('team_id',request('team_id'));
            });
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

       return $query->orderBy('sort')->get();
    }
    public function getAsignee($id){
        $project=$this->getById($id);
        $membersOnProject=$project->members->pluck('id')->toArray();
        return $membersOnProject;
    }
    public function tasksProgress($project){
        $teamsStatic=[];
        foreach (Team::all() as $k=>$team){
            $total_tasks=$project->tasks()->where('team_id',$team->id)->where('task_id',null)->count();
            $finishedtasks=$project->tasks()->where('status','FINISHED')->where('task_id',null)->where('team_id',$team->id)->count();
            $teamsStatic[$k]['name']= $team->name;
            $teamsStatic[$k]['progress']= intval($total_tasks>0?($finishedtasks/$total_tasks)*100:0);
        }
        return array_values($teamsStatic);
    }
}
