<?php

namespace App\Http\Services\Api\Panel;

use App\Http\Resources\Member\MemberResource;
use App\Http\Resources\Project\ProjectResource;
use App\Http\Resources\Report\ReportResource;
use App\Http\Traits\Responser;
use App\Repository\ReportRepositoryInterface;
use App\Repository\UserRepositoryInterface;

class PanelService
{
    use Responser;
    private $userRepository;
    private $reportRepository;
    public function __construct(UserRepositoryInterface $userRepository,ReportRepositoryInterface $reportRepository){
    $this->userRepository=$userRepository;
    $this->reportRepository=$reportRepository;
    }
    public function index(){
        $users = $this->userRepository->users();
        $reports = $this->reportRepository->todayReports();
        $receivedReports = $this->reportRepository->countByStatus('WAITING_REPLY',date:now()->format('Y-m-d'));
        $viewedReports = $this->reportRepository->countByStatus('RESPONDED',date:now()->format('Y-m-d'));
        $recentReports = $this->reportRepository->recentReports();
        $teamStatus=[
            'labels'=>[__('dashboard.OFFLINE'),__('dashboard.ONLINE'),__('dashboard.IN MEETING'),__('dashboard.OUT SICK'),__('dashboard.REMOTELY')],
            'values'=>[$users->where('current_status','OFFLINE')->count(),$users->where('current_status','ONLINE')->count(),
                $users->where('current_status','IN MEETING')->count(),$users->where('current_status','OUT SICK')->count(),
                $users->where('current_status','REMOTELY')->count()],
            'colors'=>['red','blue','yellow','purple','orange']
        ];
        if (auth('api')->user()->hasRole('user')){
            $projects = auth('api')->user()->projects;
        }else $projects = [];
        return $this->responseSuccess(data: [
            'name'=>auth()->user()->name,
            'email'=>auth()->user()->email,
            'users'=>$users->count(),
            'reports' => $reports->count(),
            'receivedReports' => $receivedReports,
            'viewedReports' => $viewedReports,
            'teamStatus' => $teamStatus,
            'projects'=>ProjectResource::collection($projects),
            'recentReports' => ReportResource::collection($recentReports),
        ]);
    }

}
