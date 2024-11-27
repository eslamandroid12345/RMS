<?php

namespace App\Http\Services\Api\Statics;



use App\Http\Resources\Static\RateStaticsResource;
use App\Http\Resources\Static\TasksStaticsResource;
use App\Http\Traits\Responser;
use App\Models\Team;
use App\Repository\TeamRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class StaticsService
{
    use Responser;
    public function __construct(private UserRepositoryInterface $userRepository, )
    {
    }
    public function rateStatics(){
        $rate_statics=$this->userRepository->getRatingStatics();
        return $this->responseSuccess(200,__('dashboard.Success'), $rate_statics);
    }
    public function tasksStatics(){
        $task_statics=$this->userRepository->getTasksStatics();
        return $this->responseSuccess(200,__('dashboard.Success'), $task_statics);
    }
}
